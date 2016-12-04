<?php
/**
 * Este es el controlador TipoPublicacion, desde aquí se gestionan
 * todas las actividades que tengan que ver con TipoPublicacion
 * @author Jorge Alejandro Quiroz Serna <alejo.jko@gmail.com>
 * @version 1.0.0
 */
class CtrlTipoPublicacion extends CControlador{
    
    /**
     * Esta función muestra el inicio y una tabla para listar los datos
     */
    public function accionInicio(){
        $modelos = TipoPublicacion::modelo()->listar();        
        $this->mostrarVista('inicio', ['modelos' => $modelos]);
    }
    
    /**
     * Esta función permite crear un nuevo registro
     */
    public function accionCrear(){
        $modelo = new TipoPublicacion();
        $this->validarNombre();
        if(isset($this->_p['TiposPublicacion'])){
            $modelo->atributos = $this->_p['TiposPublicacion'];
            if($modelo->guardar()){
                # lógica para guardado exitoso
                Sis::Sesion()->flash("alerta", [
                    'msg' => 'Tipo de publicación registrado exitosamente!',
                    'tipo' => 'success',
                ]);
                $this->redireccionar('inicio');
            }
        }
        $url = Sis::crearUrl(['TipoPublicacion/crear']);
        $this->mostrarVista('crear', ['modelo' => $modelo, 'url' => $url]);
    }
    
    /**
     * Esta función permite editar un registro existente
     * @param int $pk
     */
    public function accionEditar($pk){
        $modelo = $this->cargarModelo($pk);
        $this->validarNombre();
        if(isset($this->_p['TiposPublicacion'])){
            $modelo->atributos = $this->_p['TiposPublicacion'];
            if($modelo->guardar()){
                # lógica para guardado exitoso
                Sis::Sesion()->flash("alerta", [
                    'msg' => 'Tipo de publicación registrado exitosamente!',
                    'tipo' => 'success',
                ]);
                $this->redireccionar('inicio');
            }
        }
        $url = Sis::crearUrl(['TipoPublicacion/editar', 'id' => $pk]);
        $this->mostrarVista('editar', ['modelo' => $modelo, 'url' => $url]);
    }
    
    private function validarNombre($id = null){
        if(isset($this->_p['validarNombre'])){
            if($id === null){
                $criterio = [
                    'where' => "LOWER(nombre) = LOWER('" . $this->_p['nombre'] . "')"
                ];
            } else {
                $criterio = [
                    'where' => "id_tipo_publicacion <> $id AND LOWER(nombre) = LOWER('" . $this->_p['nombre'] . "')"
                ];
            }
            $categoria = TipoPublicacion::modelo()->primer($criterio);
            
            if($categoria != null){
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
        $publicaciones = $modelo->Publicaciones;
        if(count($publicaciones) > 0){
            Sis::Sesion()->flash("alerta", [
                'msg' => 'No se puede eliminar este tipo, ya se encuentra asociado a una publicación o más',
                'tipo' => 'error',
            ]);
        } else {
            if($modelo->eliminar()){
                # lógica para borrado exitoso
                Sis::Sesion()->flash("alerta", [
                    'msg' => 'Se eliminó correctamente el tipo de publicación',
                    'tipo' => 'success',
                ]);
            } else {
                # lógica para error al borrar
            }            
        }

        $this->redireccionar('inicio');
    }
    
    /**
     * Esta función permite cargar un modelo usando su primary key
     * @param int $pk
     * @return TipoPublicacion
     */
    private function cargarModelo($pk){
        return TipoPublicacion::modelo()->porPk($pk);
    }
}
