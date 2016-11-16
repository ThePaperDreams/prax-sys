<?php
/**
 * Este modelo es la representación de la tabla tbl_mapa_navegacion
 *
 * Atributos del modelo
 * @property int $id_opcion
 * @property string $nombre
 * @property string $descripcion
 * @property int $padre_id
 * 
 * Relaciones del modelo
 * @property FkMapaNavegacionPadre $fkMapaNavegacionPadre
 */
 class MapaNavegacion extends CModelo{
    private $hijos = null;
    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "mapa_navegacion";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_mapa_navegacion
     * @return array
     */
    public function atributos() {
        return [
            'id_opcion' => ['pk'] ,
                'nombre',
                'descripcion',
                'padre_id',
                'icono',
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
            	'fkMapaNavegacionPadre' => [self::PERTENECE_A, 'FkMapaNavegacionPadre', 'padre_id'],
        ];
    }

    public function getHijos(){
        if($this->hijos === null){
            $c = new CCriterio();
            $c->condicion("padre_id", $this->id_opcion);
            $this->hijos = self::modelo()->listar($c);
        }
        return $this->hijos;
    }
    
    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
		'id_opcion' => 'Id Opcion', 
		'nombre' => 'Nombre', 
		'descripcion' => 'Descripcion', 
		'padre_id' => 'Padre Id', 
        ];
    }
    
    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return MapaNavegacion
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }
    
    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return MapaNavegacion
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }
    
    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return MapaNavegacion
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    } 

    /**
     * Esta función retorna una instancia del modelo tbl_mapa_navegacion
     * @param string $clase
     * @return MapaNavegacion
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }
}