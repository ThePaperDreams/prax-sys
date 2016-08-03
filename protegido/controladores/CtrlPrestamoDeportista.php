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
        if($modelo->tipo_prestamo == 0){
            $deportista->estado_id = 7;
        } else {
            $deportista->estado_id = 8;
        }
        $deportista->guardar();
    }
    
    private function opcionesForm(&$modelo){
        $dm = Matricula::getDeportistasMatriculados();
        return [
            'deportistas' => CHtml::modeloLista($dm, "id_deportista", "nombreCompleto"),
            'modelo' => $modelo,
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
    
    /**
     * Esta función permite cargar un modelo usando su primary key
     * @param int $pk
     * @return PrestamoDeportista
     */
    private function cargarModelo($pk){
        return PrestamoDeportista::modelo()->porPk($pk);
    }
}
