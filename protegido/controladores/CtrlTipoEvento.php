<?php
/**
 * Este es el controlador TipoEvento, desde aquí se gestionan
 * todas las actividades que tengan que ver con TipoEvento
 * @author Jorge Alejandro Quiroz Serna <alejo.jko@gmail.com>
 * @version 1.0.0
 */
class CtrlTipoEvento extends CControlador{
    
    /**
     * Esta función muestra el inicio y una tabla para listar los datos
     */
    public function accionInicio(){
        $modelos = TipoEvento::modelo()->listar();        
        $this->mostrarVista('inicio', ['modelos' => $modelos]);
    }
    
    /**
     * Esta función permite crear un nuevo registro
     */
    public function accionCrear(){
        $this->validarNombre();
        $modelo = new TipoEvento();
        if(isset($this->_p['TiposEvento'])){
            $modelo->atributos = $this->_p['TiposEvento'];
            if($modelo->guardar()){
                # lógica para guardado exitoso
                $this->redireccionar('inicio');
            }
        }
        $url = Sis::crearUrl(['TipoEvento/crear']);
        $this->mostrarVista('crear', ['modelo' => $modelo,'url' => $url]);
    }
    
    /**
     * Esta función permite editar un registro existente
     * @param int $pk
     */
    public function accionEditar($pk){
        $this->validarNombre($pk);
        $modelo = $this->cargarModelo($pk);
        if(isset($this->_p['TiposEvento'])){
            $modelo->atributos = $this->_p['TiposEvento'];
            if($modelo->guardar()){
                # lógica para guardado exitoso
                $this->redireccionar('inicio');
            }
        }
        $url = Sis::crearUrl(['TipoEvento/editar', 'id' => $pk]);
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
                    'where' => "id_tipo <> $id AND LOWER(nombre) = LOWER('" . $this->_p['nombre'] . "')"
                ];
            }
            $categoria = CategoriaImplemento::modelo()->primer($criterio);
            
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
        if($modelo->eliminar()){
            # lógica para borrado exitoso
        } else {
            # lógica para error al borrar
        }
        $this->redireccionar('inicio');
    }
    
    /**
     * Esta función permite cargar un modelo usando su primary key
     * @param int $pk
     * @return TipoEvento
     */
    private function cargarModelo($pk){
        return TipoEvento::modelo()->porPk($pk);
    }
}
