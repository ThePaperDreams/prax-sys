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
        return [
            'deportistas' => CHtml::modeloLista($dm, "id_deportista", "nombreCompleto"),
            'modelo' => $modelo,
            'entrada' => $entrada,
        ];
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
