<?php

/**
 * Este modelo es la representación de la tabla tbl_tipos_documento
 *
 * Atributos del modelo
 * @property int $id_tipo
 * @property string $nombre
 * @property string $descripcion
 * @property int $padre_id
 *
 * Relaciones del modelo
 * @property TDocumento[] $TDocumento
 * @property Documento[] $Documentos 
 */
class TipoDocumento extends CModelo {
    private $_resumen = null;
    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "tipos_documento";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_tipos_documento
     * @return array
     */
    public function atributos() {
        return [
            'id_tipo' => ['pk'],
            'nombre',
            'descripcion',
            'padre_id',
        ];
    }

    public function filtros() {
        return [
            'requeridos' => 'nombre',
            'seguros' => '*',
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
            'TDocumento' => [self::CONTENGAN_A, 'TipoDocumento', 'padre_id'],
            'Documentos' => [self::CONTENGAN_A, 'Documento', 'tipo_id'],
        ];
    }

    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
            'id_tipo' => 'Tipo Documento',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripción',
            'padre_id' => 'Padre',
        ];
    }

    public function getResumen(){
        if($this->_resumen == null){
            $this->_resumen = strlen($this->descripcion) > 50? 
                substr($this->descripcion, 0, 50) . '...' : $this->descripcion;
        }
        return $this->_resumen;
    }

    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return TipoDocumento
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }

    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return TipoDocumento
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }
    
    public function getNombrePadre(){
        if($this->TDocumento == null){
            return null;
        } else {            
            return $this->TDocumento->nombre;
        }
    }
    
    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return TipoDocumento
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    }

    /**
     * Esta función retorna una instancia del modelo tbl_tipos_documento
     * @param string $clase
     * @return TipoDocumento
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }

}
