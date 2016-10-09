<?php
/**
 * Este modelo es la representación de la tabla tbl_deportistas_equipos
 *
 * Atributos del modelo
 * @property int $id_de
 * @property int $deportista_id
 * @property int $equipo_id
 * 
 * Relaciones del modelo
 * @property Equipo $Equipo
 * @property Deportista $Deportista
 */
 class DeportistaEquipo extends CModelo{
 
    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "deportistas_equipos";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_deportistas_equipos
     * @return array
     */
    public function atributos() {
        return [
            'id_de' => ['pk'] ,
                'deportista_id',
                'equipo_id',
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
            	'Equipo' => [self::PERTENECE_A, 'Equipo', 'equipo_id'],
            'Deportista' => [self::PERTENECE_A, 'Deportista', 'deportista_id'],
        ];
    }
    
    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
		'id_de' => 'Id De', 
		'deportista_id' => 'Deportista Id', 
		'equipo_id' => 'Equipo Id', 
        ];
    }
    
    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return DeportistaEquipo
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }
    
    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return DeportistaEquipo
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }
    
    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return DeportistaEquipo
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    } 

    /**
     * Esta función retorna una instancia del modelo tbl_deportistas_equipos
     * @param string $clase
     * @return DeportistaEquipo
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }
}