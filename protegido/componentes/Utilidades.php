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

		}
		return $this->notificaciones;
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
