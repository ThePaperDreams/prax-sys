<?php
/**
 * Este es el controlador EstadoDeportista, desde aquí se gestionan
 * todas las actividades que tengan que ver con EstadoDeportista
 * @author Jorge Alejandro Quiroz Serna <alejo.jko@gmail.com>
 * @version 1.0.0
 */
class CtrlEstadoDeportista extends CControlador{
    
    /**
     * Esta función muestra el inicio y una tabla para listar los datos
     */
    public function accionInicio(){
        $modelos = EstadoDeportista::modelo()->listar();        
        $this->mostrarVista('inicio', ['modelos' => $modelos]);
    }
    
    /**
     * Esta función permite crear un nuevo registro
     */
    public function accionCrear(){
        $this->validarNombre();
        $modelo = new EstadoDeportista();
        if(isset($this->_p['EstadoDeportistas'])){
            $modelo->atributos = $this->_p['EstadoDeportistas'];
            if($modelo->guardar()){
                $this->alertar('success', 'Registro exitoso');
                $this->redireccionar('inicio');
            }
        }
        $url = Sis::crearUrl(['EstadoDeportista/crear']);
        $this->mostrarVista('crear', ['modelo' => $modelo, 'url' => $url]);
    }
    
    private function validarNombre($id = null){
        if(isset($this->_p['validarNombre'])){
            if($id === null){
                $criterio = [
                    'where' => "nombre = '" . $this->_p['nombre'] . "'"
                ];
            } else {
                $criterio = [
                    'where' => "id_estado <> $id AND nombre = '" . $this->_p['nombre'] . "'"
                ];
            }
            $ea = EstadoDeportista::modelo()->primer($criterio);
            if($ea != null){
                $error = true;
            } else {
                $error = false;
            }
            $this->json([
                'error' => $error,
            ]);
            Sis::fin();
        }
    }
    
    /**
     * Esta función permite editar un registro existente
     * @param int $pk
     */
    public function accionEditar($pk){
        $this->validarNombre($pk);
        $modelo = $this->cargarModelo($pk);
        if(isset($this->_p['EstadoDeportistas'])){
            $modelo->atributos = $this->_p['EstadoDeportistas'];
            if($modelo->guardar()){
                $this->alertar('success', 'Actualización exitosa');
                $this->redireccionar('inicio');
            }
        }
        $url = Sis::crearUrl(['EstadoDeportista/editar', 'id' => $pk]);
        $this->mostrarVista('editar', ['modelo' => $modelo, 'url' => $url]);
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
        $deps = Deportista::modelo()->listar([
            'where' => "estado_id=$pk",
        ]);
        if (count($deps) > 0) {
            $this->alertar('error', 'No se puede eliminar');
        } else {
            if ($modelo->eliminar()) {
                $this->alertar('success', 'Estado de deportista eliminado');
            }
        }        
        $this->redireccionar('inicio');
    }
    
    private function alertar($tipo, $msj) {
        Sis::Sesion()->flash("alerta", [
            'msg' => $msj,
            'tipo' => $tipo,
        ]);
    }
    
    /**
     * Esta función permite cargar un modelo usando su primary key
     * @param int $pk
     * @return EstadoDeportista
     */
    private function cargarModelo($pk){
        return EstadoDeportista::modelo()->porPk($pk);
    }
}
