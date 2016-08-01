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
     private $_enPrestamo = null;
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
            'seguros'=>'*',
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
                'estado_id' => ['def' => '1'],
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
                
		'categoria_id' => 'Nombre categoría',
                'estado' => 'Estado',
		'nombre' => 'Nombre', 
		'descripcion' => 'Descripcion', 
		'unidades' => 'Unidades', 
		'minimo_unidades' => 'Minimo Unidades', 
		'maximo_unidades' => 'Maximo Unidades', 
        ];
    }
    public function getEtiquetaEstado(){
        if($this->getEnPrestamo()){
            return CHtml::e('span', 'En préstamo', ['class' => 'label label-info']);
        } else if($this->estado_id == 1){
            return CHtml::e('span', 'Activo', ['class' => 'label label-success']);
        } else if($this->estado_id == 0){
            return CHtml::e('span', 'Inactivo', ['class' => 'label label-danger']);
        } else {
            return CHtml::e('span', 'Agotado', ['class' => 'label label-default']);
        }
    }
    
    public function getEnPrestamo(){
        if($this->_enPrestamo === null){            
            $sql = "SELECT
                            t.id_si
                    FROM
                            tbl_salidas_implementos t
                            JOIN tbl_salidas t2 ON t2.id_salida = t.salida_id
                    WHERE t.implemento_id = $this->id_implemento AND t2.estado = 1;";
            $resultados = Sis::apl()->bd->ejecutarComando($sql);
            $this->_enPrestamo = count($resultados) > 0;
        } 
        return $this->_enPrestamo;
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
