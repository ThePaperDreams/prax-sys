<?php
/**
 * Este modelo es la representación de la tabla tbl_implementos
 *
 * Atributos del modelo
 * @property int $id_implemento
 * @property int $categoria_id
 * @property string $nombre
 * @property string $descripcion
 * @property int $unidades
 * @property int $minimo_unidades
 * @property int $maximo_unidades
 * 
 * Relaciones del modelo
 */
 class Implemento extends CModelo{
 
    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "implementos";
    }

    public function filtros() {
        return [
            'requeridos' => 'categoria_id,nombre,unidades,minimo_unidades,maximo_unidades',
            
        ];
    }
    /**
     * Esta función retorna los atributos de la tabla tbl_implementos
     * @return array
     */
    public function atributos() {
        return [
		'id_implemento' => ['pk'] , 
		'categoria_id', 
		'nombre', 
		'descripcion', 
		'unidades' => ['def' => '0'] , 
		'minimo_unidades' => ['def' => '0'] , 
		'maximo_unidades' => ['def' => '0'] , 
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
            	'Categoria' => [self::PERTENECE_A, 'CategoriaImplemento', 'categoria_id'],
        ];
    }
    
    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
		'id_implemento' => 'Id Implemento', 
		'categoria_id' => 'Categoria Id', 
		'nombre' => 'Nombre', 
		'descripcion' => 'Descripcion', 
		'unidades' => 'Unidades', 
		'minimo_unidades' => 'Minimo Unidades', 
		'maximo_unidades' => 'Maximo Unidades', 
        ];
    }
    
    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return Implemento
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }
    
    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return Implemento
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }
    
    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return Implemento
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    } 

    /**
     * Esta función retorna una instancia del modelo tbl_implementos
     * @param string $clase
     * @return Implemento
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }
}
