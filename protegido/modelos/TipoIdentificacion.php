<?php

/**
 * Este modelo es la representación de la tabla tbl_tipos_identificacion
 *
 * Atributos del modelo
 * @property int $id_tipo_documento
 * @property string $nombre
 * @property string $abreviatura
 * 
 * Relaciones del modelo
 */
class TipoIdentificacion extends CModelo {

    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "tipos_identificacion";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_tipos_identificacion
     * @return array
     */
    public function atributos() {
        return [
            'id_tipo_documento' => ['pk'],
            'nombre',
            'abreviatura',
        ];
    }

    public function filtros() {
        return [
            'requeridos' => 'nombre',
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
        ];
    }

    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
            'id_tipo_documento' => 'Tipo Documento',
            'nombre' => 'Nombre',
            'abreviatura' => 'Abreviatura',
        ];
    }

    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return TipoIdentificacion
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }

    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return TipoIdentificacion
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }

    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return TipoIdentificacion
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    }

    /**
     * Esta función retorna una instancia del modelo tbl_tipos_identificacion
     * @param string $clase
     * @return TipoIdentificacion
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }

}
