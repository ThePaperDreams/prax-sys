<?php
/**
 * Este modelo es la representación de la tabla tbl_imagenes
 *
 * Atributos del modelo
 * @property int $id_imagen
 * @property string $descripcion
 * @property string $url
 * 
 * Relaciones del modelo
 */
 class Imagen extends CModelo{
 
    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "imagenes";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_imagenes
     * @return array
     */
    public function atributos() {
        return [
            'id_imagen' => ['pk'] ,
                'descripcion',
                'url',
                'fecha',
                'titulo',
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
		'id_imagen' => 'Id Imagen', 
		'descripcion' => 'Descripcion', 
		'url' => 'Url', 
        ];
    }
    
    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return Imagen
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }
    
    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return Imagen
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }
    
    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return Imagen
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    } 

    public function antesDeGuardar(){
        if($this->nuevo){
            $this->fecha = date("Y-m-d H:i:s");
        }
    }

    /**
     * Esta función retorna una instancia del modelo tbl_imagenes
     * @param string $clase
     * @return Imagen
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }
}