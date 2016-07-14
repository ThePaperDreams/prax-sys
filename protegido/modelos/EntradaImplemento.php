<?php

/**
 * Este modelo es la representación de la tabla tbl_entradas_implementos
 *
 * Atributos del modelo
 * @property int $id_si
 * @property int $entrada_id
 * @property int $implemento_id
 * @property int $cantidad
 * @property string $detalle
 * 
 * Relaciones del modelo
 * @property Implemento $Implemento
 * @property FkTblSalidasImplementosTblImplementos1 $fkTblSalidasImplementosTblImplementos1
 */
class EntradaImplemento extends CModelo {

    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "entradas_implementos";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_entradas_implementos
     * @return array
     */
    public function atributos() {
        return [
            'id_si' => ['pk'],
            'entrada_id',
            'implemento_id',
            'cantidad' => ['def' => '0'],
            'detalle',
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
            'fkTblSalidasImplementosTblEntradas1' => [self::PERTENECE_A, 'FkTblSalidasImplementosTblEntradas1', 'entrada_id'],
        ];
    }

    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
            'id_si' => 'Id Si',
            'entrada_id' => 'Entrada Id',
            'implemento_id' => 'Implemento Id',
            'cantidad' => 'Cantidad',
            'detalle' => 'Detalle',
        ];
    }

    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return Entradas_implemento
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }

    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return Entradas_implemento
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }

    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return Entradas_implemento
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    }

    /**
     * Esta función retorna una instancia del modelo tbl_entradas_implementos
     * @param string $clase
     * @return Entradas_implemento
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }

}
