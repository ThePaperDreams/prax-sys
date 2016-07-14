<?php

/**
 * Este modelo es la representación de la tabla tbl_objetivos
 *
 * Atributos del modelo
 * @property int $id_objetivo
 * @property string $titulo
 * @property string $descripcion
 * @property int $plan_trabajo_id
 * 
 * Relaciones del modelo
 */
class Objetivo extends CModelo {

    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "objetivos";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_objetivos
     * @return array
     */
    public function atributos() {
        return [
            'id_objetivo' => ['pk'],
            'titulo',
            'descripcion',
        ];
    }

    public function filtros() {        
        return [
            'requeridos' => 'titulo',
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
        ];
    }

    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
            'id_objetivo' => 'ID',
            'titulo' => 'Titulo',
            'descripcion' => 'Descripcion',
            'plan_trabajo_id' => 'Plan Trabajo',
        ];
    }

    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return Objetivo
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }

    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return Objetivo
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }

    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return Objetivo
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    }

    /**
     * Esta función retorna una instancia del modelo tbl_objetivos
     * @param string $clase
     * @return Objetivo
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }

}
