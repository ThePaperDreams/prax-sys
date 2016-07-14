<?php
/**
 * Este es el controlador Categoria, desde aquí se gestionan
 * todas las actividades que tengan que ver con Categoria
 * @author Jorge Alejandro Quiroz Serna <alejo.jko@gmail.com>
 * @version 1.0.0
 */
class CtrlCategoria extends CControlador{
    
    /**
     * Esta función muestra el inicio y una tabla para listar los datos
     */
    public function accionInicio(){
        $modelos = Categoria::modelo()->listar();        
        $this->mostrarVista('inicio', ['modelos' => $modelos]);
    }
    
    /**
     * Esta función permite crear un nuevo registro
     */
    public function accionCrear(){
        $modelo = new Categoria();
        if(isset($this->_p['Categorias'])){
            $modelo->atributos = $this->_p['Categorias'];
            if($modelo->guardar()){
                Sis::Sesion()->flash("alerta", [
                    'msg' => 'Guardado exitoso',
                    'tipo' => 'success',
                ]);
                $this->redireccionar('inicio');
            }
        }
        
        $this->mostrarVista('crear', [
            'modelo' => $modelo,
            'entrenadores' => CHtml::modeloLista(Usuario::modelo()->listar(), "id_usuario", "nombre"),
        ]);
    }
    
    /**
     * Esta función permite editar un registro existente
     * @param int $pk
     */
    public function accionEditar($pk){
        $modelo = $this->cargarModelo($pk);
        if(isset($this->_p['Categorias'])){            
            $modelo->atributos = $this->_p['Categorias'];
            if($modelo->guardar()){
                Sis::Sesion()->flash("alerta", [
                    'msg' => 'Guardado exitoso',
                    'tipo' => 'success',
                ]);
                $this->redireccionar('inicio');
            }
        }
        $this->mostrarVista('editar', [
            'modelo' => $modelo,
            'entrenadores' => CHtml::modeloLista(Usuario::modelo()->listar(), "id_usuario", "nombre"),
        ]);
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
            Sis::Sesion()->flash("alerta", [
                'msg' => 'Se eliminó correctamente',
                'tipo' => 'success',
            ]);
        } else {
            # lógica para error al borrar
        }
        $this->redireccionar('inicio');
    }
    
    /**
     * Esta función permite cargar un modelo usando su primary key
     * @param int $pk
     * @return Categoria
     */
    private function cargarModelo($pk){
        return Categoria::modelo()->porPk($pk);
    }
}
