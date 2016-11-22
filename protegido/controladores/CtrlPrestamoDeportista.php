<?php
/**
 * Este es el controlador PrestamoDeportista, desde aquí se gestionan
 * todas las actividades que tengan que ver con PrestamoDeportista
 * @author Jorge Alejandro Quiroz Serna <alejo.jko@gmail.com>
 * @version 1.0.0
 */
class CtrlPrestamoDeportista extends CControlador{
    
    /**
     * Esta función muestra el inicio y una tabla para listar los datos
     */
    public function accionInicio(){
        $modelos = PrestamoDeportista::modelo()->listar();        
        $this->mostrarVista('inicio', ['modelos' => $modelos]);
    }
    
    /**
     * Esta función permite crear un nuevo registro
     */
    public function accionCrear(){
        $modelo = new PrestamoDeportista();
        if(isset($this->_p['PrestamosDeportista'])){
            $modelo->atributos = $this->_p['PrestamosDeportista'];
            if($modelo->guardar()){
                $this->actualizarDeportista($modelo);
                Sis::Sesion()->flash("alerta", [
                    'msg' => 'Préstamo registrado correctamente',
                    'tipo' => 'success',
                ]);
                # lógica para guardado exitoso
                $this->redireccionar('inicio');
            }
        }        
        $this->mostrarVista('crear', $this->opcionesForm($modelo));
    }

    public function accionReporte(){
        $this->tituloPagina = "Prestamo de deportistas praxis";
        $this->tituloPagina = str_replace(' ', '-', $this->tituloPagina);

        $campos = $this->_p['modelo'];
        foreach($campos AS $k=>$v){ $campos[$k] = $v == ''? null : $v; }
        $concat = "CONCAT_WS(' ', nombre1, nombre2, apellido1, apellido2,t2.apellido2)";
        $c = new CCriterio();
        $c->union("tbl_deportistas", "t2")
                ->donde("t.deportista_id", '=', "t2.id_deportista")
                ->condicion($concat, $campos['deportista_id'], 'LIKE')
                ->y("t.club_origen", $campos['club_origen'], 'LIKE')
                ->y("t.club_destino", $campos['club_destino'], 'LIKE')
                ->y("t.tipo_prestamo", $campos['tipo_prestamo'])
                ->y("t.fecha_inicio", $campos['fecha_inicio'])
                ->y("t.fecha_fin", $campos['fecha_fin'])
                ->orden("estado = 1", false)
                ->orden("id_prestamo", false);

        $prestamos = PrestamoDeportista::modelo()->listar($c);
        // var_dump(count($objetivos));
        // exit();
        $this->plantilla = "reporte";
        $pdf = Sis::apl()->mpdf->crear();
        ob_start();
        $this->vista('reporte', ['prestamos' => $prestamos]);
        $texto = ob_get_clean();
        $pdf->writeHtml($texto);
        $pdf->Output("$this->tituloPagina.pdf", 'I');
    }
    
    /**
     * 
     * @param PrestamoDeportista $modelo
     */
    private function actualizarDeportista(&$modelo){
        $deportista = $modelo->Deportista;
        if($modelo->tipo_prestamo == 'salida'){
            $deportista->estado_id = 7;
        } else {
            $deportista->estado_id = 8;
        }
        $deportista->guardar();
    }
    /**
     * 
     * @param PrestamoDeportista $modelo
     * @return type
     */
    private function opcionesForm(&$modelo){
        $dm = Matricula::getDeportistasMatriculados();
        $c = new CCriterio();
        $c->condicion("estado_id", "1");
        $dm = Deportista::modelo()->listar($c);
        $entrada = $modelo->tipo_prestamo == 'entrada';

        $clubes = Club::modelo()->listar();

        return [
            'deportistas' => CHtml::modeloLista($dm, "id_deportista", "nombreIdentificacion"),
            'modelo' => $modelo,
            'entrada' => $entrada,
            'clubes' => CHtml::modeloLista($clubes, 'id', 'nombre'),
        ];
    }

    public function accionAjax(){
        if(!isset($this->_p['ajax'])){ Sis::fin(); }

        if($this->_p['tipo'] == 'entrada'){
            $dm = Matricula::getDeporitstasMatriculadosClub(false);
        } else {
            $dm = Matricula::getDeporitstasMatriculadosClub(true);
        }
        $c = new CCriterio();
        $c->condicion("estado_id", "1");
        $ops = [CHtml::e('option', 'Seleccione un deportista')];
        foreach($dm AS $k=>$v){
            $ops[] = CHtml::e('option', $v->nombreIdentificacion, ['value' => $v->id_deportista]);
        }
        // var_dump($dm);
        // exit();
        $this->json([
            'opciones' => $ops,
            'error' => false,
        ]);
    }

    
    /**
     * Esta función permite editar un registro existente
     * @param int $pk
     */
    public function accionEditar($pk){
        $modelo = $this->cargarModelo($pk);
        if(isset($this->_p['PrestamosDeportista'])){
            $modelo->atributos = $this->_p['PrestamosDeportista'];
            if($modelo->guardar()){
                # lógica para guardado exitoso
                $this->actualizarDeportista($modelo);
                Sis::Sesion()->flash("alerta", [
                    'msg' => 'Préstamo actualizado correctamente',
                    'tipo' => 'success',
                ]);
                $this->redireccionar('inicio');
            }
        }
        $this->mostrarVista('editar', $this->opcionesForm($modelo));
    }
    
    /**
     * Esta función permite ver detalladamente un registro existente
     * @param int $pk
     */
    public function accionVer($pk){
        $modelo = $this->cargarModelo($pk);
        $this->mostrarVista('ver', ['modelo' => $modelo]);
    }
    
    /**
     * Esta función permite eliminar un registro existente
     * @param int $pk
     */
    public function accionEliminar($pk){
        $modelo = $this->cargarModelo($pk);
        $deportista = $modelo->Deportista;
        if($modelo->eliminar()){
            $deportista->estado_id = 1;
            $deportista->guardar();
            # lógica para borrado exitoso
        } else {
            # lógica para error al borrar
        }
        $this->redireccionar('inicio');
    }
    
    public function accionFinalizar($pk){
        $modelo = $this->cargarModelo($pk);
        $deportista = $modelo->Deportista;
        $modelo->estado = 0;
        $deportista->estado_id = 1;
        if($modelo->guardar() && $deportista->guardar()){
            Sis::Sesion()->flash("alerta", [
                'msg' => 'Se finalizó correctamente el préstamo',
                'tipo' => 'success',
            ]);            
        } else {
            Sis::Sesion()->flash("alerta", [
                    'msg' => 'Ocurrió un error al finalizar el préstamo',
                    'tipo' => 'error',
                ]);
        }
        $this->redireccionar('inicio');
    }
    
    /**
     * Esta función permite cargar un modelo usando su primary key
     * @param int $pk
     * @return PrestamoDeportista
     */
    private function cargarModelo($pk){
        return PrestamoDeportista::modelo()->porPk($pk);
    }
}
