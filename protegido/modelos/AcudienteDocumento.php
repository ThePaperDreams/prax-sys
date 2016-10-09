<?php

/**
 * Este modelo es la representación de la tabla tbl_acudientes_documentos
 *
 * Atributos del modelo
 * @property int $id
 * @property int $acudiente_id
 * @property int $documento_id
 * 
 * Relaciones del modelo
 * @property Acudiente $Acudiente
 * @property Documento $Documento
 */
class AcudienteDocumento extends CModelo {

    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "acudientes_documentos";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_acudientes_documentos
     * @return array
     */
    public function atributos() {
        return [
            'id' => ['pk'],
            'acudiente_id',
            'documento_id',
        ];
    }

    public function filtros() {
        return [
            'requeridos' => 'acudiente_id,documento_id',
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
            'Acudiente' => [self::PERTENECE_A, 'Acudiente', 'acudiente_id'],
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
            'acudiente_id' => 'Acudiente',
            'documento_id' => 'Documento',
        ];
    }

    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return AcudienteDocumento
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }

    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return AcudienteDocumento
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }

    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return AcudienteDocumento
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    }

    /**
     * Esta función retorna una instancia del modelo tbl_acudientes_documentos
     * @param string $clase
     * @return AcudienteDocumento
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }

}
