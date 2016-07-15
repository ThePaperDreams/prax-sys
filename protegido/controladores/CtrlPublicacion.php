<?php
/**
 * Este es el controlador Publicacion, desde aquí se gestionan
 * todas las actividades que tengan que ver con Publicacion
 * @author Jorge Alejandro Quiroz Serna <alejo.jko@gmail.com>
 * @version 1.0.0
 */

class CtrlPublicacion extends CControlador{
    
    /**
     * Esta función muestra el inicio y una tabla para listar los datos
     */
    public function accionInicio(){
        $modelos = Publicacion::modelo()->listar();        
        $this->mostrarVista('inicio', ['modelos' => $modelos,
            'public' => CHtml::modelolista(TipoPublicacion::modelo()->listar(), "id_tipo_publicacion", "nombre"),      
            'usuar' => CHtml::modelolista(Usuario::modelo()->listar(), "id_usuario", "nombre"),
            'estd' => CHtml::modelolista(EstadoPublicacion::modelo()->listar(), "id_estado", "nombre"),
            ]);
    }
    
    /**
     * Esta función permite crear un nuevo registro
     */
    public function accionCrear(){
        $modelo = new Publicacion();
        if(isset($this->_p['Publicaciones'])){
            $modelo->atributos = $this->_p['Publicaciones'];
            $modelo->usuario_id = Sis::apl()->usuario->ID;
            if($modelo->guardar()){
                
                $this->redireccionar('inicio');
            }
        }      
        $this->mostrarVista('crear',
            ['modelo' => $modelo,
            'public' => CHtml::modelolista(TipoPublicacion::modelo()->listar(), "id_tipo_publicacion", "nombre"),
            'estd' => CHtml::modelolista(EstadoPublicacion::modelo()->listar(), "id_estado", "nombre"),    
            ]);
        
        
    }
    
    /**
     * Esta función permite editar un registro existente
     * @param int $pk
     */
    public function accionEditar($pk){
        $modelo = $this->cargarModelo($pk);
        if(isset($this->_p['Publicaciones'])){
            $modelo->atributos = $this->_p['Publicaciones'];
            $modelo->usuario_id = Sis::apl()->usuario->ID;
            if($modelo->guardar()){
                # lógica para guardado exitoso
                $this->redireccionar('inicio');
            }
        }
        $this->mostrarVista('editar',
            ['modelo' => $modelo,
            'public' => CHtml::modelolista(TipoPublicacion::modelo()->listar(), "id_tipo_publicacion", "nombre"),
            'estd' => CHtml::modelolista(EstadoPublicacion::modelo()->listar(), "id_estado", "nombre"),    
            ]);
        
        
    }
    
    /**
     * Esta función permite ver detalladamente un registro existente
     * @param int $pk
     */
    public function accionVer($pk){
        $modelo = $this->cargarModelo($pk);
        $this->mostrarVista('ver',
            ['modelo' => $modelo,
            'public' => CHtml::modelolista(TipoPublicacion::modelo()->listar(), "id_tipo_publicacion", "nombre"),      
            'usuar' => CHtml::modelolista(Usuario::modelo()->listar(), "id_usuario", "nombre"),
            'estd' => CHtml::modelolista(EstadoPublicacion::modelo()->listar(), "id_estado", "nombre"),    
            ]);
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
     * @return Publicacion
     */
    private function cargarModelo($pk){
        return Publicacion::modelo()->porPk($pk);
    }
}
