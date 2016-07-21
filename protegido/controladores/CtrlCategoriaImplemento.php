<?php
/**
 * Este es el controlador CategoriaImplemento, desde aquí se gestionan
 * todas las actividades que tengan que ver con CategoriaImplemento
 * @author Jorge Alejandro Quiroz Serna <alejo.jko@gmail.com>
 * @version 1.0.0
 */
class CtrlCategoriaImplemento extends CControlador{
    
    /**
     * Esta función muestra el inicio y una tabla para listar los datos
     */
    public function accionInicio(){
        $modelos = CategoriaImplemento::modelo()->listar();        
        $this->mostrarVista('inicio', ['modelos' => $modelos]);
    }
    
    /**
     * Esta función permite crear un nuevo registro
     */
    public function accionCrear(){
        $modelo = new CategoriaImplemento();
        if(isset($this->_p['CategoriasImplementos'])){
            $modelo->atributos = $this->_p['CategoriasImplementos'];
            if($modelo->guardar()){
                # lógica para guardado exitoso
                $this->redireccionar('inicio');
            }
        }
        $this->mostrarVista('crear', ['modelo' => $modelo]);
    }
    
    /**
     * Esta función permite editar un registro existente
     * @param int $pk
     */
    public function accionEditar($pk){
        $modelo = $this->cargarModelo($pk);
        if(isset($this->_p['CategoriasImplementos'])){
            $modelo->atributos = $this->_p['CategoriasImplementos'];
            if($modelo->guardar()){
                # lógica para guardado exitoso
                $this->redireccionar('inicio');
            }
        }
        $this->mostrarVista('editar', ['modelo' => $modelo]);
    }
    
    /**
     * Esta función permite ver detalladamente un registro existente
     * @param int $pk
     */
    public function accionVer($pk){
        $modelo = $this->cargarModelo($pk);
        $this->mostrarVista('ver', ['modelo' => $modelo]);
    }
    
     public function accionAnular($pk) {
        $modelo = $this->cargarModelo($pk);
        $modelo->estado =  !$modelo->estado;
        if ($modelo->guardar()) {
            Sis::Sesion()->flash("alerta", [
                'msg' => 'Categoría inactiva',
                'tipo' => 'success',
            ]);
        } else {
            # lógica para error al borrar
        }
        $this->redireccionar('inicio');
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
     * @return CategoriaImplemento
     */
    private function cargarModelo($pk){
        return CategoriaImplemento::modelo()->porPk($pk);
    }
}
