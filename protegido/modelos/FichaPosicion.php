<?php

/**
 * Este modelo es la representación de la tabla tbl_fichas_posiciones
 *
 * Atributos del modelo
 * @property int $id_fp
 * @property int $ficha_id
 * @property int $posicion_id
 * 
 * Relaciones del modelo
 * @property FichaTecnica $Ficha
 * @property Posicion $Posicion
 */
class FichaPosicion extends CModelo {

    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "fichas_posiciones";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_fichas_posiciones
     * @return array
     */
    public function atributos() {
        return [
            'id_fp' => ['pk'],
            'ficha_id',
            'posicion_id',
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
            'FichaTecnica' => [self::PERTENECE_A, 'FichaTecnica', 'ficha_id'],
            'Posicion' => [self::PERTENECE_A, 'Posicion', 'posicion_id'],
        ];
    }

    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
            'id_fp' => 'Id Fp',
            'ficha_id' => 'Ficha Id',
            'posicion_id' => 'Posicion Id',
        ];
    }

    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return FichaPosicion
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }

    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return FichaPosicion
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }

    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return FichaPosicion
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    }

    /**
     * Esta función retorna una instancia del modelo tbl_fichas_posiciones
     * @param string $clase
     * @return FichaPosicion
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }

}
