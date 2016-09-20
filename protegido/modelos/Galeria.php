<?php
/**
 * Este modelo es la representación de la tabla tbl_galerias
 *
 * Atributos del modelo
 * @property int $id_galeria
 * @property string $titulo
 * @property int $evento_id
 * 
 * Relaciones del modelo
 * @property FkTblGaleriasTblEventos1 $fkTblGaleriasTblEventos1
 */
 class Galeria extends CModelo{
 
    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "galerias";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_galerias
     * @return array
     */
    public function atributos() {
        return [
            'id_galeria' => ['pk'] ,
                'titulo',
                'evento_id',
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
            	'fkTblGaleriasTblEventos1' => [self::PERTENECE_A, 'FkTblGaleriasTblEventos1', 'evento_id'],
        ];
    }
    
    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
		'id_galeria' => 'Id Galeria', 
		'titulo' => 'Titulo', 
		'evento_id' => 'Evento Id', 
        ];
    }
    
    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return Galeria
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }
    
    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return Galeria
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }
    
    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return Galeria
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    } 

    /**
     * Esta función retorna una instancia del modelo tbl_galerias
     * @param string $clase
     * @return Galeria
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }
}