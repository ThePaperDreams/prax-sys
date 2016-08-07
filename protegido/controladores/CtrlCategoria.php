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
        $this->validarCategoria();
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
        $url = Sis::crearUrl(['categoria/crear']);
        $this->mostrarVista('crear', [
            'modelo' => $modelo,
            'entrenadores' => CHtml::modeloLista(Usuario::modelo()->listar(), "id_usuario", "nombres"),
            'url' => $url,
        ]);
    }
    
    /**
     * Esta función permite editar un registro existente
     * @param int $pk
     */
    public function accionEditar($pk){
        $this->validarCategoria($pk);
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
        
        $url = Sis::crearUrl(['categoria/editar', 'id' => $pk]);
        $this->mostrarVista('editar', [
            'modelo' => $modelo,
            'entrenadores' => CHtml::modeloLista(Usuario::modelo()->listar(), "id_usuario", "nombres"),
            'url' => $url,
        ]);
    }
    
    private function validarCategoria($id = null){
        if(isset($this->_p['nombre'])){            
            $nombre = $this->_p['nombre'];
            $criterio = $id === null? 
                     "LOWER(nombre)=LOWER('$nombre')" : 
                    "id_categoria <> $id AND LOWER(nombre)=LOWER('$nombre')";
            $model = Categoria::modelo()->listar([
                'where' => $criterio,
            ]);
            $this->json([
                'existe' => count($model) > 0,
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
        try{
            if($modelo->eliminar()){
                Sis::Sesion()->flash("alerta", [
                    'msg' => 'Se eliminó correctamente',
                    'tipo' => 'success',
                ]);
            } else {
                # lógica para error al borrar
            }            
        } catch (Exception $ex) {
            Sis::Sesion()->flash("alerta", [
                'msg' => 'Ocurrió un error al eliminar la categoría Error #00001',
                'tipo' => 'error',
            ]);
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
