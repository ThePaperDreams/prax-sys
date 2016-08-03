<?php
/**
 * Este modelo es la representación de la tabla tbl_equipos_torneos
 *
 * Atributos del modelo
 * @property int $id_et
 * @property int $equipo_id
 * @property int $torneo_id
 * 
 * Relaciones del modelo
 */
 class EquipoTorneo extends CModelo{
 
    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "equipos_torneos";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_equipos_torneos
     * @return array
     */
    public function atributos() {
        return [
		'id_et' => ['pk'] , 
		'equipo_id', 
		'torneo_id', 
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
            'Equipos' => [self::PERTENECE_A, 'Equipo', 'equipo_id'],
            'Torneos' => [self::PERTENECE_A, 'Torneo', 'torneo_id'],
        ];
    }
    
    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
		'id_et' => 'Id Et', 
		'equipo_id' => 'Equipo ', 
		'torneo_id' => 'Torneo', 
        ];
    }
    
    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return EquipoTorneo
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }
   

        /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return EquipoTorneo
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }
    
    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return EquipoTorneo
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    } 

    /**
     * Esta función retorna una instancia del modelo tbl_equipos_torneos
     * @param string $clase
     * @return EquipoTorneo
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }
}
