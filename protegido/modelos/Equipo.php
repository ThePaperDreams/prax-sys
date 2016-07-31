<?php
/**
 * Este modelo es la representación de la tabla tbl_equipos
 *
 * Atributos del modelo
 * @property int $id_equipo
 * @property int $cupo_maximo
 * @property int $cupo_minimo
 * @property int $estado
 * @property int $posicion
 * @property int $entrenador_id
 * @property int $deportista_id
 * 
 * Relaciones del modelo
 */
 class Equipo extends CModelo{
 
    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "equipos";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_equipos
     * @return array
     */
    public function atributos() {
        return [
		'id_equipo' => ['pk'] , 
		'cupo_maximo', 
		'cupo_minimo', 
		'estado' => ['def' => '1'] , 
		'posicion', 
		'entrenador_id', 
		'deportista_id', 
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
            'Deportista' => [self::PERTENECE_A, 'Deportista', 'deportista_id'],
        ];
    }
    
    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
		'id_equipo' => 'Id Equipo', 
		'cupo_maximo' => 'Cupo Máximo', 
		'cupo_minimo' => 'Cupo Mínimo', 
		'estado' => 'Estado', 
		'posicion' => 'Posición', 
		'entrenador_id' => 'Entrenador', 
		'deportista_id' => 'Deportistas', 
        ];
    }
    public function filtros() {
        return [
            'requeridos' => 'cupo_maximo, cupo_minimo, estado, deportista_id,entrenador_id',
            'seguros' => '*',
        ];
    }
    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return Equipo
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }
    
    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return Equipo
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }
    
    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return Equipo
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    } 

    /**
     * Esta función retorna una instancia del modelo tbl_equipos
     * @param string $clase
     * @return Equipo
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }
}