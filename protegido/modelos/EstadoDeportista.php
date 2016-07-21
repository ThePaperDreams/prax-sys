<?php
/**
 * Este modelo es la representación de la tabla tbl_estado_deportistas
 *
 * Atributos del modelo
 * @property int $id_estado
 * @property string $nombre
 * @property string $descripcion
 * @property string $icono
 * @property string $etiqueta
 * 
 * Relaciones del modelo
 */
 class EstadoDeportista extends CModelo{
 
    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "estado_deportistas";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_estado_deportistas
     * @return array
     */
    public function atributos() {
        return [
		'id_estado' => ['pk'] , 
		'nombre', 
		'descripcion', 
		'icono', 
		'etiqueta', 
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

    public function filtros() {
        return [
            'requeridos' => 'nombre',
        ];
    }

    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
            'id_estado' => 'Estado',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripción',
            'icono' => 'Icono', 
            'etiqueta' => 'Etiqueta',
        ];
    }
    
    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return EstadoDeportista
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }
    
    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return EstadoDeportista
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }
    
    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return EstadoDeportista
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    } 

    /**
     * Esta función retorna una instancia del modelo tbl_estado_deportistas
     * @param string $clase
     * @return EstadoDeportista
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }
}
