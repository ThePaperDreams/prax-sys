<?php

/**
 * Este modelo es la representación de la tabla tbl_documentos
 *
 * Atributos del modelo
 * @property int $id_documento
 * @property string $url
 * @property string $titulo
 * @property int $tipo_id
 * @property tinyint $papelera
 * 
 * Relaciones del modelo
 * @property TipoDocumento $TipoDocumento
 */
class Documento extends CModelo {

    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "documentos";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_documentos
     * @return array
     */
    public function atributos() {
        return [
            'id_documento' => ['pk'],
            'url',
            'titulo',
            'tipo_id',
            'papelera' => ['def' => '0'],
        ];
    }

    public function filtros() {
        return [
            'requeridos' => 'url,titulo,tipo_id',
        ];
    }

    /**
     * Esta función retorna las relaciones con otros modelos
     * @return array
     */
    protected function relaciones() {
        return [
            # el formato es simple: 
            # tipo de relación | modelo con que se relaciona | campo clave foranea
            'TipoDocumento' => [self::PERTENECE_A, 'TipoDocumento', 'tipo_id'],
        ];
    }

    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
            'id_documento' => 'Documento',
            'url' => 'Url',
            'titulo' => 'Título',
            'tipo_id' => 'Tipo',
            'papelera' => 'Papelera',
        ];
    }

    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return Documento
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }

    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return Documento
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }

    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return Documento
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    }

    /**
     * Esta función retorna una instancia del modelo tbl_documentos
     * @param string $clase
     * @return Documento
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }
    
    public function getDatos() {
        return $this->titulo;
    }
    
    // Usado en Acudientes y Deportistas
    public function getDocumento($ruta) {        
        $icono = CBoot::fa("cloud-download");
        $url = Sis::UrlBase() . "publico/" . $ruta;
        return CHtml::link($icono . ' ' . $this->titulo, $url, ['target' => '_blank', 'download' => $this->titulo]);
    }
    
    // Usado en Documentos
    public function getDocumentos(){
        $icono = CBoot::fa("cloud-download");
        $url = Sis::UrlBase() . $this->url;
        return CHtml::link($icono . " $this->titulo", $url, ['target' => '_blank', 'download' => $this->url]);
    }
}