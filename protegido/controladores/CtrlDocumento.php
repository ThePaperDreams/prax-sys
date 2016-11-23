<?php
/**
 * Este es el controlador Documento, desde aquí se gestionan
 * todas las actividades que tengan que ver con Documento
 * @author Jorge Alejandro Quiroz Serna <alejo.jko@gmail.com>
 * @version 1.0.0
 */
class CtrlDocumento extends CControlador{
    public $ayuda;
    public $ayudaTitulo;
    /**
     * Esta función muestra el inicio y una tabla para listar los datos
     */
    public function accionInicio(){
        if(isset($this->_p['ajx'])){
            $this->listarDirectorios();
        }
        
        $categorias = TipoDocumento::modelo()->listar([
            'where' => 'padre_id IS NULL',
        ]);
        
        $this->mostrarVista('inicio', ['categorias' => $categorias]);
    }
    
    private function listarDirectorios(){
        $html = [];
        $carpeta = null;
        if(isset($this->_p['id']) && $this->_p['id'] !== ""){
            $this->construirCarpeta($html, "..", '', true);
            $carpeta = TipoDocumento::modelo()->porPk($this->_p['id']);
            $carpetas = $carpeta->TDocumento;            
        } else {
            $carpetas = TipoDocumento::modelo()->listar([
                'where' => 'padre_id IS NULL',
            ]);
        }
        if($carpetas != null){
            foreach($carpetas AS $k=>$v){
                $this->construirCarpeta($html, $v->nombre, $v->id_tipo);
            }            
        }
        if($carpeta !== null){ $this->cargarArchivos($carpeta, $html); }
        $this->json([
            'items' => implode('', $html),
        ]);
        Sis::fin();
    }
    
    /**
     * @param array $html
     * @param TipoDocumento $categoria
     */
    private function cargarArchivos($categoria, &$html){
        $documentos = $categoria->Documentos;
        $urlBase = Sis::urlBase();
        foreach($documentos AS $doc){
            $nombre = str_replace('/', '', substr($doc->url, strrpos($doc->url, '/')));
            // $icono = $this->encontrarIcono($nombre);
            // $i = CBoot::fa($icono);
            $pre = CHtml::img($urlBase . 'publico/documentos/' . $doc->url);
            $input = CBoot::text($doc->titulo, ['readonly' => true, 'onclick' => '$(this).select();']);
            $a = CHtml::link($pre, $urlBase . 'publico/documentos/' . $doc->url, ['download' => $nombre, 'class' => 'preview-doc']);
            $li = CHtml::e('li', $a. $input, ['class' => 'carpeta archivo', 'data-nombre' => strtolower($nombre)]);
            $html[] = $li;
        }
    }
    
    private function encontrarIcono($nombre){
        $ext = strtolower(substr($nombre, strrpos($nombre, '.') + 1));
        if($ext == 'pdf'){
            return 'file-pdf-o';
        } else if($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg' || $ext == 'gif'){
            return 'file-image-o';
        } else {
            return 'file-o';
        }
    }
    
    /**
     * 
     * @param array $html
     * @param string $nombre
     * @param string $tipo
     */
    private function construirCarpeta(&$html, $nombre, $tipo, $atras = false){
        $i = CBoot::fa('folder');
        $a = CHtml::link($nombre, '#');
        $li = CHtml::e('li', $i . $a, ['class' => 'carpeta' .(!$atras? " carpeta-adentro" : ' carpeta-atras') , 'data-id' => $tipo]);
        $html[] = $li;
    }
    
    /**
     * Esta función permite crear un nuevo registro
     */
    public function accionCrear(){
        $this->redireccionar('inicio');
        $modelo = new Documento();
        if(isset($this->_p['Documentos'])){
            $modelo->atributos = $this->_p['Documentos'];
            if($modelo->guardar()){
                # lógica para guardado exitoso
                $this->redireccionar('inicio');
            }
        }
        $this->mostrarVista('crear', ['modelo' => $modelo,
            'tiposDocumentos' => CHtml::modeloLista(TipoDocumento::modelo()->listar(), "id_tipo", "nombre"),
        ]);
    }
    
    /**
     * Esta función permite editar un registro existente
     * @param int $pk
     */
    public function accionEditar($pk){
        $this->redireccionar('inicio');
        $modelo = $this->cargarModelo($pk);
        if(isset($this->_p['Documentos'])){
            $modelo->atributos = $this->_p['Documentos'];
            if($modelo->guardar()){
                # lógica para guardado exitoso
                $this->redireccionar('inicio');
            }
        }
        $this->mostrarVista('editar', ['modelo' => $modelo,
            'tiposDocumentos' => CHtml::modeloLista(TipoDocumento::modelo()->listar(), "id_tipo", "nombre"),
        ]);
    }
    
    /**
     * Esta función permite ver detalladamente un registro existente
     * @param int $pk
     */
    public function accionVer($pk){
        $this->redireccionar('inicio');
        $modelo = $this->cargarModelo($pk);
        $this->mostrarVista('ver', ['modelo' => $modelo,
            'tiposDocumentos' => CHtml::modeloLista(TipoDocumento::modelo()->listar(), "id_tipo", "nombre"),
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
     * @return Documento
     */
    private function cargarModelo($pk){
        return Documento::modelo()->porPk($pk);
    }
}
