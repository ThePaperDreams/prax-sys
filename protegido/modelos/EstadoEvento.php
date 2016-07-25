<?php
/**
 * Este modelo es la representación de la tabla tbl_estados_evento
 *
 * Atributos del modelo
 * @property int $id_estado
 * @property string $nombre
 * @property string $descripcion
 * 
 * Relaciones del modelo
 */
 class EstadoEvento extends CModelo{
 
    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "estados_evento";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_estados_evento
     * @return array
     */
    public function atributos() {
        return [
            'id_estado' => ['pk'] ,
                'nombre',
                'descripcion',
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
		'id_estado' => 'Id Estado', 
		'nombre' => 'Nombre', 
		'descripcion' => 'Descripcion', 
        ];
    }
    
    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return EstadoEvento
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }
    
    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return EstadoEvento
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }
    
    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return EstadoEvento
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    } 

    /**
     * Esta función retorna una instancia del modelo tbl_estados_evento
     * @param string $clase
     * @return EstadoEvento
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }
}