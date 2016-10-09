<?php

/**
 * Este modelo es la representación de la tabla tbl_objetivos_planes
 *
 * Atributos del modelo
 * @property int $id_op
 * @property int $objetivo_id
 * @property int $plan_id
 * 
 * Relaciones del modelo
 * @property Objetivo $Objetivo
 * @property PlanTrabajo $PlanTrabajo
 */
class ObjetivoPlan extends CModelo {

    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "objetivos_planes";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_objetivos_planes
     * @return array
     */
    public function atributos() {
        return [
            'id_op' => ['pk'],
            'objetivo_id',
            'plan_id',
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
            'Objetivo' => [self::PERTENECE_A, 'Objetivo', 'objetivo_id'],
            'PlanTrabajo' => [self::PERTENECE_A, 'PlanTrabajo', 'plan_id'],
        ];
    }

    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
            'id_op' => 'Id Op',
            'objetivo_id' => 'Objetivo Id',
            'plan_id' => 'Plan Id',
        ];
    }

    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return ObjetivoPlan
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }

    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return ObjetivoPlan
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }

    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return ObjetivoPlan
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    }

    /**
     * Esta función retorna una instancia del modelo tbl_objetivos_planes
     * @param string $clase
     * @return ObjetivoPlan
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }

}
