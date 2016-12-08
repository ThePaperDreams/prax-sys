<?php

class Utilidades extends CComponenteAplicacion{
	private $notificaciones = null;

	public function visitasHoy(){
		$c = new CCriterio();
		$c->condicion("fecha", date("Y-m-d"));
		$visitas = Visita::modelo()->listar($c);
		$total = 0;
		foreach ($visitas as $v) {
			$total += intval($v->vistas);
		}
		return $total;
	}

	public function visitasMes(){
		$c = new CCriterio();

		$c->entre("fecha", date("Y-m-01"), date("Y-m-t"));
		$visitas = Visita::modelo()->listar($c);
		$total = 0;
		foreach ($visitas as $v) {
			$total += intval($v->vistas);
		}
		return $total;
	}

	public function comentariosSinAprobar(){
		$c = new CCriterio();
		$c->condicion("estado", "2");
		return Comentario::modelo()->contar($c);
	}

	public function eventosCalendario(){
		$c = new CCriterio();
		$c->entre("fecha", date("Y-m-01"), date("Y-m-t"))
			->columnas("fecha")
			->agrupar("fecha");
		$eventos = Evento::modelo()->listar($c);
		$e = [];
		foreach($eventos AS $evento){
			$e[] = $evento->fecha;
		}
		return json_encode($e);
	}

	public function getNotificaciones(){
		if($this->notificaciones == null){			
			$this->notificaciones = [];
			$this->notiEventosHoy();
			$this->notiEventos();	
			$this->notiComentarios();
			$this->listaEspera();
			$this->entregaImplementos();
			$this->mensualidadesVencidas();
			$this->pagosMes();
		}
		return $this->notificaciones;
	}

	private function mensualidadesVencidas(){
		$c = new CCriterio();		
		$fini = date("Y-m-01");
		$c->condicion("t.fecha_inicio", $fini, "<");
		$pagos = Pago::modelo()->contar($c);
		if($pagos > 0){
			$this->notificaciones[] = [
				'texto' => 'Hay mensualidades atrasadas ',
				'icono' => 'clock-o',
				'url' => Sis::crearUrl(['pago/pagosPendientes']),
			];
		}
	}

	private function pagosMes(){
		$c = new CCriterio();		
		$fini = date("Y-m-01");
		$c->condicion("t.fecha_inicio", $fini);
		$pagos = Pago::modelo()->contar($c);
		if($pagos > 0){
			$this->notificaciones[] = [
				'texto' => 'Hay mensualidades pendientes por cobrar este mes',
				'icono' => 'money',
				'url' => Sis::crearUrl(['pago/pagosPendientes']),
			];
		}
	}

	private function entregaImplementos(){
		$c = new CCriterio();
		$c->condicion("fecha_entrega", date("Y-m-d"));
		$implementos = Salida::modelo()->contar($c);
		# implementos que se entregan el día actual
		if($implementos > 0){
			$this->notificaciones[] = [
				'texto' => 'Hay implementos que deben ser recibidos hoy',
				'icono' => 'exchange',
				'url' => Sis::crearUrl(['salida/inicio']),
			];
		}

		# implementos que ya vencio la entrega
		$c->limpiar('condicion');
		$c->condicion("fecha_entrega", date("Y-m-d"), '<')
			->y("estado", 1);
		$implementos = Salida::modelo()->contar($c);

		if($implementos > 0){
			$this->notificaciones[] = [
				'texto' => 'Hay implementos préstados cuya fecha de entrega expiró',
				'icono' => 'exclamation-triangle',
				'url' => Sis::crearUrl(['salida/inicio']),
			];
		}
	}

	private function listaEspera(){
		$cl = new CCriterio();
		$cl->condicion("estado", 1)
			->agrupar("categoria_id");
		$listaEspera = CHtml::modeloLista(ListaEspera::modelo()->listar($cl), 'id_lista', 'categoria_id');

		$disponibles = [];
		
		if(count($listaEspera) > 0){
			$cc = new CCriterio();
			$cc->en("id_categoria", $listaEspera);
			$categorias = Categoria::modelo()->listar($cc);

			foreach($categorias AS $k=>$v){
				if($v->getDisponibilidad() > 0){
					$disponibles[] = $v->nombre;
				}
			}
		}

		if(count($disponibles) > 0){
			$this->notificaciones[] = [
				'texto' => 'Hay deportistas en lista de espera para las categorías: <b>' . implode(', ', $disponibles) . '</b>',
				'icono' => 'check-circle-o',
				'url' => Sis::crearUrl(['deportista/verListaEspera']),
			];
		}

	}

	private function notiEventos(){
		$c = new CCriterio();
		$c->condicion("fecha", date("Y-m-d"), ">")
			->y("estado", "1");
		$eventos = Evento::modelo()->contar($c);
		if($eventos > 0){
			$this->notificaciones[] = [
				'texto' => ($eventos > 1)? "Se acercan $eventos eventos." : "Se acerca $eventos evento.",
				'icono' => 'calendar-plus-o',
				'url' => Sis::crearUrl(['evento/inicio']),
			];
		}
	}

	public function getEventos(){
		$c = new CCriterio();
		$c->condicion("fecha", date("Y-m-d"), ">")
			->y("estado", "1");
		$eventos = Evento::modelo()->contar($c);
		return $eventos;
	}

	private function notiEventosHoy(){
		$c = new CCriterio();
		$c->condicion("fecha", date("Y-m-d"), "=")
			->y("estado", "1");
		$eventos = Evento::modelo()->contar($c);
		if($eventos > 0){
			$this->notificaciones[] = [
				'texto' => ($eventos > 1)? "Hoy tenemos $eventos eventos." : "Hoy tenemos $eventos evento.",
				'icono' => 'calendar-check-o',
				'url' => Sis::crearUrl(['evento/inicio']),
			];
		}
	}

	private function notiComentarios(){
		$comentarios = $this->comentariosSinAprobar();
		if($comentarios > 0){
			$this->notificaciones[] = [
				'texto' => 'Hay comentarios sin aprobar',
				'icono' => 'comments',
				'url' => Sis::crearUrl(['publicacion/inicio']),
			];	
		}
	}

}
