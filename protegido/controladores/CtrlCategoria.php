<?php
/**
 * Este es el controlador Categoria, desde aquí se gestionan
 * todas las actividades que tengan que ver con Categoria
 * @author Jorge Alejandro Quiroz Serna <alejo.jko@gmail.com>
 * @version 1.0.0
 */
class CtrlCategoria extends CControlador{
    public $ayuda;
    public $ayudaTitulo;
    private $rolEntrenador = 4;

    /**
     * Esta función muestra el inicio y una tabla para listar los datos
     */
    public function accionInicio(){
        $criterios = new CCriterio();
        $criterios->orden('estado = 1', false)
            ->orden("id_categoria", false);
        $this->mostrarVista('inicio', ['criterios' => $criterios]);
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

        $c = new CCriterio();
        $c->condicion("rol_id", $this->rolEntrenador);
        $entrenadores = Usuario::modelo()->listar($c);

        $url = Sis::crearUrl(['categoria/crear']);
        $this->mostrarVista('crear', [
            'modelo' => $modelo,
            'entrenadores' => CHtml::modeloLista($entrenadores, "id_usuario", "nombres"),
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
    
    public function accionCambiarEstado($pk){
        # instanciamos el modelo
        $modelo = $this->cargarModelo($pk);
                
        $modelo->estado = $modelo->estado == 1? 0 : 1;
        if($modelo->guardar()){
            Sis::Sesion()->flash("alerta", [ 'msg' => 'Se cambió exitosametne el estado', 'tipo' => 'success']);
        } else {
            Sis::Sesion()->flash("alerta", [ 'msg' => 'Ocurrió un error al cambiar el estado', 'tipo' => 'Error']);
        }
        $this->redireccionar('inicio');
    }
    
    /**
     * Esta función permite eliminar un registro existente
     * @param int $pk
     */
    public function accionEliminar($pk){
        $modelo = $this->cargarModelo($pk);
        if($modelo->enUso === true){
            Sis::Sesion()->flash("alerta", ['msg' => 'La categoría se encuentra en uso', 'tipo' => 'warning']);
            $this->redireccionar('inicio');
        }
        try{
            $modelo->eliminar();
            Sis::Sesion()->flash("alerta", [
                'msg' => 'Se eliminó correctamente',
                'tipo' => 'success',
            ]);
        } catch (Exception $ex) {
            Sis::Sesion()->flash("alerta", [ 'msg' => 'Ocurrió un error al eliminar la categoría','tipo' => 'error' ]);
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
