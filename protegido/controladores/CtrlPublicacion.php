<?php
/**
 * Este es el controlador Publicacion, desde aquí se gestionan
 * todas las actividades que tengan que ver con Publicacion
 * @author Jorge Alejandro Quiroz Serna <alejo.jko@gmail.com>
 * @version 1.0.0
 */

class CtrlPublicacion extends CControlador{
    
    public function accionCargarImagenes(){
        if(isset($this->_p['ajx'])){
            $this->cargarImagen();
        }
        $imagenes = Imagen::modelo()->listar();
        $this->vista("cargarImagenes", [
            'imagenes' => $imagenes
        ]);
    }
    
    private function cargarImagen(){        
        $imagen = CArchivoCargado::instanciarPorNombre('imagenes');
        $rutaDes = Sis::resolverRuta(Sis::crearCarpeta("!publico.imagenes.publicaciones"));
        $rutaThumbs = Sis::resolverRuta(Sis::crearCarpeta("!publico.imagenes.publicaciones.thumbs"));
        $guardado = $imagen->guardar($rutaDes);
        $error = true;
        if($guardado){
            $imagen->thumbnail($rutaThumbs, [
                'tamanio' => 200,
                'autocentrar' => true,
                'tipo' => strtolower($imagen->getExtension()),
            ]);
            $mImagen = new Imagen();
            $mImagen->url = $imagen->getNombreOriginal();
            $mImagen->guardar();            
            $error = false;
        }
        
        header("Content-type: Application/json");
        
        echo json_encode([
            'uploadErr' => $error,
            'url' => Sis::UrlBase() . "/publico/imagenes/publicaciones/thumbs/tmb_$mImagen->url",
        ]);
        Sis::fin();
    }
    
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
                Sis::Sesion()->flash("alerta", [
                    'msg' => 'Publicación registrada exitosamente!',
                    'tipo' => 'success',
                ]);
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
                Sis::Sesion()->flash("alerta", [
                    'msg' => 'Publicación editada exitosamente!',
                    'tipo' => 'success',
                ]);
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
