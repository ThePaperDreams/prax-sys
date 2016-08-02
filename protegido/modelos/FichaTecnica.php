<?php
/**
 * Este modelo es la representación de la tabla tbl_fichas_tecnicas
 *
 * Atributos del modelo
 * @property int $id_ficha_tecnica
 * @property int $amonestacion
 * @property int $dorsal
 * @property int $expulsion
 * @property string $fecha_actualizacion
 * @property float $peso
 * @property tinyint $pierna_habil
 * @property int $entrenador_id
 * @property float $talla
 * @property float $valoracion
 * @property string $rh
 * @property int $deportista_id
 * 
 * Relaciones del modelo
 * @property FkTblFichasTecnicasTblPersonas1 $fkTblFichasTecnicasTblPersonas1
 */
 class FichaTecnica extends CModelo{
 
    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "fichas_tecnicas";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_fichas_tecnicas
     * @return array
     */
    public function atributos() {
        return [
            'id_ficha_tecnica' => ['pk'] ,
                'amonestacion' => ['def' => '0'] ,
                'dorsal',
                'expulsion',
                'fecha_actualizacion',
                'peso',
                'pierna_habil',
                'entrenador_id',
                'talla',
                'valoracion',
                'rh',
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
            	'fkTblFichasTecnicasTblPersonas1' => [self::PERTENECE_A, 'FkTblFichasTecnicasTblPersonas1', 'deportista_id'],
        ];
    }
    
    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
		'id_ficha_tecnica' => 'Id Ficha Tecnica', 
		'amonestacion' => 'Amonestacion', 
		'dorsal' => 'Dorsal', 
		'expulsion' => 'Expulsion', 
		'fecha_actualizacion' => 'Fecha Actualizacion', 
		'peso' => 'Peso', 
		'pierna_habil' => 'Pierna Habil', 
		'entrenador_id' => 'Entrenador Id', 
		'talla' => 'Talla', 
		'valoracion' => 'Valoracion', 
		'rh' => 'Rh', 
		'deportista_id' => 'Deportista Id', 
        ];
    }
    
    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return FichaTecnica
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }
    
    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return FichaTecnica
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }
    
    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return FichaTecnica
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    } 

    /**
     * Esta función retorna una instancia del modelo tbl_fichas_tecnicas
     * @param string $clase
     * @return FichaTecnica
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }
}