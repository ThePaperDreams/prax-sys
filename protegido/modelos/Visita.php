<?php
/**
 * Este modelo es la representación de la tabla tbl_visitas
 *
 * Atributos del modelo
 * @property int $id
 * @property int $publicacion_id
 * @property int $vistas
 * @property string $fecha
 * 
 * Relaciones del modelo
 */
 class Visita extends CModelo{
 
    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "visitas";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_visitas
     * @return array
     */
    public function atributos() {
        return [
		'id' => ['pk'] , 
		'publicacion_id', 
		'vistas', 
		'fecha', 
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
            	'fkVisitasPublicaciones' => [self::PERTENECE_A, 'FkVisitasPublicaciones', 'publicacion_id'],
        ];
    }
    
    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
		'id' => 'Id', 
		'publicacion_id' => 'Publicacion Id', 
		'vistas' => 'Vistas', 
		'fecha' => 'Fecha', 
        ];
    }
    
    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return Visita
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }
    
    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return Visita
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }
    
    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return Visita
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    } 

    /**
     * Esta función retorna una instancia del modelo tbl_visitas
     * @param string $clase
     * @return Visita
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }
}
