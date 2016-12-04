<?php 

class CtrlReportes extends CControlador{

	public function accionTodos(){
		$this->vista("todos");
	}

	public function accionPagosPendientes(){
		$pagos = [];
		$fechaIni = null;
		$fechaFin = null;
		$deportistas = CHtml::modeloLista(Matricula::getMatriculados(), 'id_deportista', 'nombreCompleto');

		$this->vista('pagos/pagosPendientes', [
			'pagosPendientes' => $pagos,
			'fechaIni' => $fechaIni,
			'fechaFin' => $fechaFin,
			'deportistas' => $deportistas,
		]);
	}

	public function accionPagosRealizados(){
		$this->vista('pagos/pagosRealizados');
	}

	public function accionImplementos(){
		$this->vista("implementos/implementos");
	}

	public function accionImplementosPrestados(){
		$this->vista("implementos/prestamos");
	}

	public function accionImplementosEntradas(){
		$this->vista("implementos/entradas");
	}

	public function accionDeportistasAcudientes(){
		if(isset($this->_p['modelo'])){
			$this->pdfDeportistasAcudientes();
		}

		$this->vista("deportistas/deportistasAcudientes",[
			'estados' => CHtml::modelolista(EstadoDeportista::modelo()->listar(), "id_estado", "nombre"),
		]);
	}

	public function accionAcudientesDeportistas(){
		if(isset($this->_p['modelo'])){
			$this->pdfDeportistasAcudientes();
		}

		$this->vista("deportistas/acudientesDeportistas",[
			'estados' => CHtml::modelolista(EstadoDeportista::modelo()->listar(), "id_estado", "nombre"),
		]);	
	}

	private function pdfDeportistasAcudientes(){
		$this->tituloPagina = "Acudientes por deportista";

        $campos = $this->_p['modelo'];
        foreach($campos AS $k=>$v){ $campos[$k] = $v == ''? null : $v; }

        $c = new CCriterio();
        $concat = "CONCAT_WS(' ', t.nombre1,t.nombre2,t.apellido1,t.apellido2)";
        $c->condicion($concat, $this->_nombreCompleto, "LIKE")
            ->y("t.identificacion", $this->identificacion, "LIKE")
            ->agrupar("t.id_deportista")
            ->orden("t.id_deportista", false);

        $deportistas = Deportista::modelo()->listar($c);

        $this->plantilla = "reporte";
        $pdf = Sis::apl()->mpdf->crear();
        ob_start();
        $this->vista('deportistas/pdfDeportistasAcudientes', ['deportistas' => $deportistas]);
        $texto = ob_get_clean();
        $pdf->writeHtml($texto);
        $pdf->Output("Deportistas-praxis.pdf", 'I');
        Sis::fin();
	}

	public function accionDeportistas(){
		$this->vista("deportistas/todos",[
			'estados' => CHtml::modelolista(EstadoDeportista::modelo()->listar(), "id_estado", "nombre"),
		]);
	}

}