<?php
/**
 * Este es el controlador Evento, desde aquí se gestionan
 * todas las actividades que tengan que ver con Evento
 * @author Jorge Alejandro Quiroz Serna <alejo.jko@gmail.com>
 * @version 1.0.0
 */
class CtrlEvento extends CControlador{
    
    /**
     * Esta función muestra el inicio y una tabla para listar los datos
     */
    public function accionInicio(){
        $modelos = Evento::modelo()->listar();        
        $this->mostrarVista('inicio', ['modelos' => $modelos,
            'TipoEvento' => CHtml::modelolista(TipoEvento::modelo()->listar(), "id_tipo", "nombre"),      
            'Autor' => CHtml::modelolista(Usuario::modelo()->listar(), "id_usuario", "nombre"),
            'Estado' => CHtml::modelolista(EstadoEvento::modelo()->listar(), "id_estado", "nombre"),
            ]);
        
    }
    
    /**
     * Esta función permite crear un nuevo registro
     */
    public function accionCrear(){
        $this->validarNombre();
        $modelo = new Evento();
        if(isset($this->_p['Eventos'])){
            $modelo->atributos = $this->_p['Eventos'];
//            echo "<pre>";
//            var_dump($modelo);
//            exit();
            if($modelo->guardar()){
                # lógica para guardado exitoso
                Sis::Sesion()->flash("alerta", [
                    'msg' => 'Guardado exitoso',
                    'tipo' => 'success',]);
                $this->redireccionar('inicio');
            }
        }
        $url = Sis::crearUrl(['Evento/crear']);
        $this->mostrarVista('crear', ['modelo' => $modelo,'url' => $url,
            'TipoEvento' => CHtml::modelolista(TipoEvento::modelo()->listar(), "id_tipo", "nombre"),      
            'Autor' => CHtml::modelolista(Usuario::modelo()->listar(), "id_usuario", "nombre"),
            'Estado' => CHtml::modelolista(EstadoEvento::modelo()->listar(), "id_estado", "nombre"),
            
            ]);
    }
    
    /**
     * Esta función permite editar un registro existente
     * @param int $pk
     */
    public function accionEditar($pk){
        $this->validarNombre($pk);
        $modelo = $this->cargarModelo($pk);
        if(isset($this->_p['Eventos'])){
            $modelo->atributos = $this->_p['Eventos'];
            if($modelo->guardar()){
                # lógica para guardado exitoso
                $this->redireccionar('inicio');
            }
        }
        $url = Sis::crearUrl(['Evento/editar', 'id' => $pk]);
        $this->mostrarVista('editar', ['modelo' => $modelo,'url' => $url,
            'TipoEvento' => CHtml::modelolista(TipoEvento::modelo()->listar(), "id_tipo", "nombre"),      
            'Autor' => CHtml::modelolista(Usuario::modelo()->listar(), "id_usuario", "nombre"),
            'Estado' => CHtml::modelolista(EstadoEvento::modelo()->listar(), "id_estado", "nombre"),
            ]);
    }
    
    
    private function validarNombre($id = null){
        if(isset($this->_p['validarNombre'])){
            if($id === null){
                $criterio = [
                    'where' => "LOWER(titulo) = LOWER('" . $this->_p['nombre'] . "')"
                ];
            } else {
                $criterio = [
                    'where' => "id_evento <> $id AND LOWER(titulo) = LOWER('" . $this->_p['nombre'] . "')"
                ];
            }
            $categoria = Evento::modelo()->primer($criterio);
            
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
     * @return Evento
     */
    private function cargarModelo($pk){
        return Evento::modelo()->porPk($pk);
    }
}
