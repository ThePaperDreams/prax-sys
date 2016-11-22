<?php
/**
 * Este modelo es la representación de la tabla tbl_clubes
 *
 * Atributos del modelo
 * @property int $id
 * @property string $nombre
 * @property string $direccion
 * @property string $telefono
 * @property int $estado
 * 
 * Relaciones del modelo
 */
 class Club extends CModelo{
 
    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "clubes";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_clubes
     * @return array
     */
    public function atributos() {
        return [
            'id' => ['pk'] ,
                'nombre',
                'direccion',
                'telefono',
                'estado',
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
		'id' => 'Id', 
		'nombre' => 'Nombre', 
		'direccion' => 'Direccion', 
		'telefono' => 'Telefono', 
		'estado' => 'Estado', 
        ];
    }
    
    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return Club
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }
    
    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return Club
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }
    
    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return Club
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    } 

    /**
     * Esta función retorna una instancia del modelo tbl_clubes
     * @param string $clase
     * @return Club
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }
}