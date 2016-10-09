<?php

/**
 * Este modelo es la representación de la tabla tbl_deportistas_documentos
 *
 * Atributos del modelo
 * @property int $id
 * @property int $deportista_id
 * @property int $documento_id
 * 
 * Relaciones del modelo
 * @property Deportista $Deportista
 * @property Documento $Documento
 */
class DeportistaDocumento extends CModelo {

    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "deportistas_documentos";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_deportistas_documentos
     * @return array
     */
    public function atributos() {
        return [
            'id' => ['pk'],
            'deportista_id',
            'documento_id',
        ];
    }

    public function filtros() {
        return [
            'requeridos' => 'deportista_id,documento_id',
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
            'Deportista' => [self::PERTENECE_A, 'Deportista', 'deportista_id'],
            'Documento' => [self::PERTENECE_A, 'Documento', 'documento_id'],
        ];
    }

    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
            'id' => 'Id',
            'deportista_id' => 'Deportista',
            'documento_id' => 'Documento',
        ];
    }

    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return DeportistaDocumento
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }

    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return DeportistaDocumento
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }

    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return DeportistaDocumento
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    }

    /**
     * Esta función retorna una instancia del modelo tbl_deportistas_documentos
     * @param string $clase
     * @return DeportistaDocumento
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }

}
