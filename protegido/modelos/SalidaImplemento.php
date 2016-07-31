<?php

/**
 * Este modelo es la representación de la tabla tbl_salidas_implementos
 *
 * Atributos del modelo
 * @property int $id_si
 * @property int $salida_id
 * @property int $implemento_id
 * @property int $cantidad
 * @property string $detalle
 * @property int $cantidad_devuelta 
 * 
 * Relaciones del modelo
 * @property Implemento $Implemento
 * @property FkTblSalidasImplementosTblSalidas1 $fkTblSalidasImplementosTblSalidas1
 */
class SalidaImplemento extends CModelo {

    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "salidas_implementos";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_salidas_implementos
     * @return array
     */
    public function atributos() {
        return [
            'id_si' => ['pk'],
            'salida_id',
            'implemento_id',
            'cantidad' => ['def' => '0'],
            'detalle',
            'cantidad_devuelta',
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
            'Implemento' => [self::PERTENECE_A, 'Implemento', 'implemento_id'],
            'fkTblSalidasImplementosTblSalidas1' => [self::PERTENECE_A, 'FkTblSalidasImplementosTblSalidas1', 'salida_id'],
        ];
    }

    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
            'id_si' => 'Id Si',
            'salida_id' => 'Salida Id',
            'implemento_id' => 'Implemento Id',
            'cantidad' => 'Cantidad',
            'detalle' => 'Detalle',
        ];
    }

    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return SalidaImplemento
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }

    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return SalidaImplemento
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }

    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return SalidaImplemento
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    }

    /**
     * Esta función retorna una instancia del modelo tbl_salidas_implementos
     * @param string $clase
     * @return SalidaImplemento
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }

}
