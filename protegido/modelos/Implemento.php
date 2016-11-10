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
            'requeridos' => 'categoria_id,nombre,unidades,minimo_unidades',
            'seguros'=>'*',
        ];
    }
    public function filtrosAjx() {
        $criterio = new CCriterio();
        $criterio->condicion("t1.nombre", $this->categoria_id, "LIKE")
           ->union("tbl_categorias_implementos", "t1")
           ->donde("t1.id_categoria", "=", "t.categoria_id")
           ->y("t.nombre", $this->nombre, "LIKE")     
           ->y("t.estado_id", $this->estado_id, "=")
           ->y("t.unidades", $this->unidades, "=")
           ->y("t.minimo_unidades", $this->minimo_unidades, "=")      
           ->y("t.maximo_unidades", $this->maximo_unidades, "=")
           ->orden('estado_id = 1', false)
           ->orden('t.nombre');
        
       return $criterio;
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
                'estado_id' => 'Estado',
		'nombre' => 'Nombre Implemento', 
		'descripcion' => 'Descripcion', 
		'unidades' => 'Unid. Disponibles', 
		'minimo_unidades' => 'Min. Unidades', 
		'maximo_unidades' => 'Max. Unidades', 
        ];
    }
    
    public function getEtiquetaEstado(){ 
        if($this->estado_id == 1){
            return CHtml::e('span', 'Activo', ['class' => 'label label-success']);
        } else if($this->estado_id == 2){
            return CHtml::e('span', 'Inactivo', ['class' => 'label label-danger']);
        } else if($this->estado_id == 3){
            return CHtml::e('span', 'Agotado', ['class' => 'label label-default']);
        }
    }
    
    public function getNombreEstado(){
        if($this->getEnPrestamo()){
            return  CHtml::e('span', 'En préstamo', ['class' => 'label label-info label-prestamo']) . " " . $this->nombre;
        } else {
            return $this->nombre;
        }
    }
    
    public function getEnPrestamo(){
        if($this->_enPrestamo === null){            
            $sql = "SELECT
                            t.id_si
                    FROM
                            tbl_salidas_implementos t
                            JOIN tbl_salidas t2 ON t2.id_salida = t.salida_id
                    WHERE t.implemento_id = $this->id_implemento AND t2.estado = 1";
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
