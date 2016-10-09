<?php
/**
 * Este es el controlador Objetivo, desde aquí se gestionan
 * todas las actividades que tengan que ver con Objetivo
 * @author Jorge Alejandro Quiroz Serna <alejo.jko@gmail.com>
 * @version 1.0.0
 */
class CtrlObjetivo extends CControlador{
    public $ayuda;
    public $ayudaTitulo;
    /**
     * Esta función muestra el inicio y una tabla para listar los datos
     */
    public function accionInicio(){
        $modelos = Objetivo::modelo()->listar();        
        $this->mostrarVista('inicio', ['modelos' => $modelos]);
    }
    
    /**
     * Esta función permite crear un nuevo registro
     */
    public function accionCrear(){
        $this->validarObjetivo();   # esta función se usa para validar la existencia de un objetivo via ajax
        $modelo = new Objetivo();
        if(isset($this->_p['Objetivos'])){
            $modelo->atributos = $this->_p['Objetivos'];
            if($modelo->guardar()){
                Sis::Sesion()->flash("alerta", [
                    'msg' => 'Guardado exitoso',
                    'tipo' => 'success',
                ]);
                $this->redireccionar('inicio');
            }
        }
        $url = Sis::crearUrl(['objetivo/crear']);
        $this->mostrarVista('crear', ['modelo' => $modelo, 'url' => $url]);
    }
    
    /**
     * Esta función permite editar un registro existente
     * @param int $pk
     */
    public function accionEditar($pk){
        $this->validarObjetivo($pk);   # esta función se usa para validar la existencia de un objetivo via ajax
        $modelo = $this->cargarModelo($pk);
        if(isset($this->_p['Objetivos'])){
            $modelo->atributos = $this->_p['Objetivos'];
            if($modelo->guardar()){
                Sis::Sesion()->flash("alerta", [
                    'msg' => 'Guardado exitoso',
                    'tipo' => 'success',
                ]);
                $this->redireccionar('inicio');
            }
        }
        $url = Sis::crearUrl(['objetivo/editar', 'id' => $pk]);
        $this->mostrarVista('editar', ['modelo' => $modelo, 'url' => $url]);
    }
    
    private function validarObjetivo($id = null){   
        if(isset($this->_p['obj'])){
            $nombre = $this->_p['obj'];
            $criterio = $id === null? 
                     "LOWER(titulo)=LOWER('$nombre')" : 
                    "id_objetivo <> $id AND LOWER(titulo)=LOWER('$nombre')";
            $obj = Objetivo::modelo()->listar([
                'where' => $criterio,
            ]);
            $this->json([
                'existe' => count($obj) > 0,
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
        $obPlanes = ObjetivoPlan::modelo()->listar([
            'where' => "objetivo_id=$pk",
        ]);
        if(count($obPlanes) > 0){
            Sis::Sesion()->flash("alerta", [
                'msg' => 'No se puede eliminar este objetivo, probablemente ya esté asociado a un plan de trabajo',
                'tipo' => 'error',
            ]);
        }else if($modelo->eliminar()){
            Sis::Sesion()->flash("alerta", [
                'msg' => 'Se eliminó correctamente',
                'tipo' => 'success',
            ]);
        }
        $this->redireccionar('inicio');
    }
    
    /**
     * Esta función permite cargar un modelo usando su primary key
     * @param int $pk
     * @return Objetivo
     */
    private function cargarModelo($pk){
        return Objetivo::modelo()->porPk($pk);
    }
}
