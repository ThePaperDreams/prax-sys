<?php
/**
 * Este es el controlador TipoIdentificacion, desde aquí se gestionan
 * todas las actividades que tengan que ver con TipoIdentificacion
 * @author Jorge Alejandro Quiroz Serna <alejo.jko@gmail.com>
 * @version 1.0.0
 */
class CtrlTipoIdentificacion extends CControlador{
    
    /**
     * Esta función muestra el inicio y una tabla para listar los datos
     */
    public function accionInicio(){
        $modelos = TipoIdentificacion::modelo()->listar();        
        $this->mostrarVista('inicio', ['modelos' => $modelos]);
    }
    
    /**
     * Esta función permite crear un nuevo registro
     */
    public function accionCrear(){
        $this->validarNombre();
        $modelo = new TipoIdentificacion();
        if(isset($this->_p['TiposIdentificacion'])){
            $modelo->atributos = $this->_p['TiposIdentificacion'];
            if($modelo->guardar()){
                $this->alertar('success', 'Guardado Exitoso');                
                # lógica para guardado exitoso
                $this->redireccionar('inicio');
            }
        }
        $url = Sis::crearUrl(['TipoIdentificacion/crear']);
        $this->mostrarVista('crear', ['modelo' => $modelo, 'url' => $url]);
    }
    
    private function validarNombre($id = null){
        if(isset($this->_p['validarNombre'])){
            if($id === null){
                $criterio = [
                    'where' => "LOWER(nombre) = LOWER('" . $this->_p['nombre'] . "')"
                ];
            } else {
                $criterio = [
                    'where' => "id_tipo_documento <> $id AND LOWER(nombre) = LOWER('" . $this->_p['nombre'] . "')"
                ];
            }
            $tipo_identificacion = TipoIdentificacion::modelo()->primer($criterio);
            if($tipo_identificacion != null){
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
    
    private function alertar($tipo, $msj) {
        Sis::Sesion()->flash("alerta", [
            'msg' => $msj,
            'tipo' => $tipo,
        ]);
    }
    
    /**
     * Esta función permite editar un registro existente
     * @param int $pk
     */
    public function accionEditar($pk){
        $this->validarNombre($pk);
        $modelo = $this->cargarModelo($pk);
        if(isset($this->_p['TiposIdentificacion'])){
            $modelo->atributos = $this->_p['TiposIdentificacion'];
            if($modelo->guardar()){
                $this->alertar('success', 'Modificación exitosa');                
                # lógica para guardado exitoso
                $this->redireccionar('inicio');
            }
        }
        $url = Sis::crearUrl(['TipoIdentificacion/editar', 'id' => $pk]);
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
        $dep = Deportista::modelo()->listar([
            'where' => "tipo_documento_id=$pk",
        ]);
        $acu = Acudiente::modelo()->listar([
            'where' => "tipo_doc_id=$pk",
        ]);
        if(count($dep) > 0 || count($acu) > 0){
            $this->alertar('error','No se puede eliminar');
        }else if($modelo->eliminar()){
            $this->alertar('success','Eliminación Exitosa');
        }
        $this->redireccionar('inicio');
    }
    
    /**
     * Esta función permite cargar un modelo usando su primary key
     * @param int $pk
     * @return TipoIdentificacion
     */
    private function cargarModelo($pk){
        return TipoIdentificacion::modelo()->porPk($pk);
    }
}
