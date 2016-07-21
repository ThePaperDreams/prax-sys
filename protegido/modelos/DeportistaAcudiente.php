<?php

/**
 * Este modelo es la representación de la tabla tbl_deportistas_acudientes
 *
 * Atributos del modelo
 * @property int $id
 * @property int $id_acudiente
 * @property int $id_deportista
 * 
 * Relaciones del modelo
 * @property Acudiente $Acudiente
 * @property Deportista $Deportista
 */
class DeportistaAcudiente extends CModelo {

    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "deportistas_acudientes";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_deportistas_acudientes
     * @return array
     */
    public function atributos() {
        return [
            'id' => ['pk'],
            'id_acudiente',
            'id_deportista',
        ];
    }

    public function filtros() {
        return [
            'requeridos' => 'id_acudiente, id_deportista',
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
            'Acudiente' => [self::PERTENECE_A, 'Acudiente', 'id_acudiente'],
            'Deportista' => [self::PERTENECE_A, 'Deportista', 'id_deportista'],
        ];
    }

    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
            'id' => 'Id',
            'id_acudiente' => 'Acudiente',
            'id_deportista' => 'Deportista',
        ];
    }

    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return DeportistaAcudiente
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }

    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return DeportistaAcudiente
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }

    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return DeportistaAcudiente
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    }

    /**
     * Esta función retorna una instancia del modelo tbl_deportistas_acudientes
     * @param string $clase
     * @return DeportistaAcudiente
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }

}
