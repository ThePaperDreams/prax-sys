<?php
/**
 * Este modelo es la representación de la tabla tbl_posiciones
 *
 * Atributos del modelo
 * @property int $id_posicion
 * @property string $posicion
 * @property string $abreviatura
 * 
 * Relaciones del modelo
 */
 class Posicion extends CModelo{
 
    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "posiciones";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_posiciones
     * @return array
     */
    public function atributos() {
        return [
            'id_posicion' => ['pk'] ,
                'posicion',
                'abreviatura',
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
		'id_posicion' => 'Id Posicion', 
		'posicion' => 'Posicion', 
		'abreviatura' => 'Abreviatura', 
        ];
    }
    
    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return Posicion
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }
    
    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return Posicion
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }
    
    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return Posicion
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    } 

    /**
     * Esta función retorna una instancia del modelo tbl_posiciones
     * @param string $clase
     * @return Posicion
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }
}