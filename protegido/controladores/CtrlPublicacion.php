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

    public function accionConfiguracion(){

        $this->vista("configuracion");
    }

    public function accionSitioWeb(){
        if(isset($this->_p['redes'])){
            foreach($this->_p['redes'] AS $k=>$v){
                $config = Configuracion::get("redes_" . $k, true);
                $config->valor = $v;
                $config->guardar();
            }
            $nosotros = Configuracion::get("quienes_somos", true);
            $nosotros->valor = $this->_p['contenido_publicacion'];
            $nosotros->guardar();
            $this->redireccionar("sitioWeb");
        }
        $this->vista("sitioWeb", [
            'facebook' => Configuracion::get("redes_facebook"),
            'twitter' => Configuracion::get("redes_twitter"),
            'instagram' => Configuracion::get("redes_instagram"),
            'youtube' => Configuracion::get("redes_facebook"),
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
    
    public function accionAjx(){
        if(isset($this->_p['upload-imgs'])){
            $this->cargarImagenesGaleria();
        } else if(isset($this->_p['delete-img'])){
            $this->borrarImagen();
        }
        Sis::fin();
    }
    
    private function borrarImagen(){
        $pk = $this->_p['id'];
        $modelo = Imagen::modelo()->porPk($pk);
        $rutaBase = Sis::resolverRuta('!publico.imagenes.galerias');
        unlink($rutaBase . DS . $modelo->url);
        unlink($rutaBase . DS . 'thumbs' . DS . "tmb_" . $modelo->url);
        $this->json([
            'error' => !$modelo->eliminar(),
        ]);
    }
    
    private function cargarImagenesGaleria(){
        $rutaDestino = $rutaDestino = Sis::resolverRuta("!publico.imagenes.galerias");
        $nombreImagen = $this->guardarLaImagen($rutaDestino);
        $mImagen = new Imagen();
        $mImagen->url = $nombreImagen;
        Sis::apl()->bd->begin();
        $error = false;
        if($nombreImagen !== false && $mImagen->guardar()){
            Sis::apl()->bd->commit();
        } else if($nombreImagen === false){
            Sis::apl()->bd->rollback();
            $error = true;
        } else {
            unlink($rutaDestino . DS . $mImagen->url);
            unlink($rutaDestino . DS . "thumbs" . DS . $mImagen->url);
            $error = true;
            Sis::apl()->bd->rollback();
        }
        $this->json([
            'uploadErr' => $error,
            'id' => $mImagen->id_imagen,
            'url' => Sis::UrlBase() . 'publico/imagenes/galerias/thumbs/tmb_' . $nombreImagen,
            'urlReal' => Sis::UrlBase() . 'publico/imagenes/galerias/' . $nombreImagen,
        ]);
    }
    
    private function guardarLaImagen($rutaDestino){
        $imagen = CArchivoCargado::instanciarPorNombre('imagenes');
        if($imagen == null || $imagen->getError() !== CArchivoCargado::NINGUNO){ return false; }
        $guardada = $imagen->guardar($rutaDestino) && 
        $imagen->thumbnail($rutaDestino . DS . 'thumbs',[
            'autocentrar' => true,
            'tamanio' => 300,
            'tipo' => strtolower($imagen->getExtension())
        ]);
        return $guardada? $imagen->getNombre(true) : false;
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
       $this->validarNombre();
        $modelo = new Publicacion();
        if(isset($this->_p['Publicaciones'])){
            $modelo->atributos = $this->_p['Publicaciones'];
            
            $modelo->usuario_id = Sis::apl()->usuario->ID;
            if($modelo->tipo_id == 2){
            $modelo->consecutivo = $modelo->getUltimo();
            }
            if($modelo->guardar()){
                Sis::Sesion()->flash("alerta", [
                    'msg' => 'Publicación registrada exitosamente!',
                    'tipo' => 'success',
                ]);
                $this->redireccionar('inicio');
            }
        }
        $url = Sis::crearUrl(['Publicacion/crear']);
        $this->mostrarVista('crear',
            [
            'modelo' => $modelo,'url' => $url,
            'public' => CHtml::modelolista(TipoPublicacion::modelo()->listar(), "id_tipo_publicacion", "nombre"),
            'estd' => CHtml::modelolista(EstadoPublicacion::modelo()->listar(), "id_estado", "nombre"),    
                'imagenes' => Imagen::modelo()->listar(['order' => 'id_imagen DESC']),
            ]);
    }    
    
    
    /**
     * Esta función permite editar un registro existente
     * @param int $pk
     */
    public function accionEditar($pk){
        $this->validarNombre($pk);
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
        $url = Sis::crearUrl(['Publicacion/editar', 'id' => $pk]);
        $this->mostrarVista('editar',
            ['modelo' => $modelo,'url' => $url,
            'public' => CHtml::modelolista(TipoPublicacion::modelo()->listar(), "id_tipo_publicacion", "nombre"),
            'estd' => CHtml::modelolista(EstadoPublicacion::modelo()->listar(), "id_estado", "nombre"),    
                'imagenes' => Imagen::modelo()->listar(['order' => 'id_imagen DESC']),
            ]);
        
        
    }
    
     private function validarNombre($id = null){
        if(isset($this->_p['validarNombre'])){
            if($id === null){
                $criterio = [
                    'where' => "LOWER(titulo) = LOWER('" . $this->_p['titulo'] . "')"
                ];
            } else {
                $criterio = [
                    'where' => "id_publicacion <> $id AND LOWER(titulo) = LOWER('" . $this->_p['titulo'] . "')"
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
        if(isset($this->_p['ajxRqst'])){
            $this->aprobarRemoverComentario();
            Sis::fin();
        }

        $modelo = $this->cargarModelo($pk);
        $this->mostrarVista('ver',
            ['modelo' => $modelo,
            'public' => CHtml::modelolista(TipoPublicacion::modelo()->listar(), "id_tipo_publicacion", "nombre"),      
            'usuar' => CHtml::modelolista(Usuario::modelo()->listar(), "id_usuario", "nombre"),
            'estd' => CHtml::modelolista(EstadoPublicacion::modelo()->listar(), "id_estado", "nombre"),    
            ]);
    }

    private function aprobarRemoverComentario(){
        $t = $this->_p['tipo'];
        $comentario = Comentario::modelo()->porPk($this->_p['id']);
        $json = [];
        if($t == 1){
            $comentario->estado = 1;
            $json['error'] = !$comentario->guardar();
            $json['estado'] = 1;
        } else if($t == 2){
            if(count($comentario->respuestas) > 0){
                foreach($comentario->respuestas AS $respuesta){
                    $respuesta->eliminar();
                }
            }
            $json['error'] = !$comentario->eliminar();
            $json['estado'] = '0';
        }
        $this->json($json);
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
