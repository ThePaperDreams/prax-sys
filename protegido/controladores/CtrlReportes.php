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

	public function accionDeportistas(){
		$this->vista("deportistas/todos",[
			'estados' => CHtml::modelolista(EstadoDeportista::modelo()->listar(), "id_estado", "nombre"),
		]);
	}

}