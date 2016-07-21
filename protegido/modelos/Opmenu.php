<?php

/**
 * Este modelo es la representación de la tabla tbl_opmenu
 *
 * Atributos del modelo
 * @property int $id
 * @property string $texto
 * @property int $ruta_id
 * @property int $padre_id
 * 
 * Relaciones del modelo
 * @property Ruta $Ruta
 * @property Padre $Padre
 */
class Opmenu extends CModelo {

    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "opmenu";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_opmenu
     * @return array
     */
    public function atributos() {
        return [
            'id' => ['pk'],
            'texto',
            'ruta_id',
            'padre_id',
        ];
    }

    public function filtros() {
        return[
            'requeridos' => 'texto,ruta_id',
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
            'Padre' => [self::PERTENECE_A, 'Opmenu', 'padre_id'],
            'Ruta' => [self::PERTENECE_A, 'Ruta', 'ruta_id'],
        ];
    }

    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
            'id' => 'Opmenu',
            'texto' => 'Texto',
            'ruta_id' => 'Ruta',
            'padre_id' => 'Padre',
        ];
    }

    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return Opmenu
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }

    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return Opmenu
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }

    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return Opmenu
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    }

    /**
     * Esta función retorna una instancia del modelo tbl_opmenu
     * @param string $clase
     * @return Opmenu
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }

}
