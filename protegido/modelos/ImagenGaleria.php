<?php
/**
 * Este modelo es la representación de la tabla tbl_imagenes_galerias
 *
 * Atributos del modelo
 * @property int $id
 * @property int $imagen_id
 * @property int $galeria_id
 * 
 * Relaciones del modelo
 * @property FkTblImagenesGaleriasTblGalerias1 $fkTblImagenesGaleriasTblGalerias1
 * @property FkTblImagenesGaleriasTblImagenes1 $fkTblImagenesGaleriasTblImagenes1
 */
 class ImagenGaleria extends CModelo{
 
    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "imagenes_galerias";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_imagenes_galerias
     * @return array
     */
    public function atributos() {
        return [
            'id' => ['pk'] ,
                'imagen_id',
                'galeria_id',
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
            	'fkTblImagenesGaleriasTblGalerias1' => [self::PERTENECE_A, 'FkTblImagenesGaleriasTblGalerias1', 'galeria_id'],
	'fkTblImagenesGaleriasTblImagenes1' => [self::PERTENECE_A, 'FkTblImagenesGaleriasTblImagenes1', 'imagen_id'],
        ];
    }
    
    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
		'id' => 'Id', 
		'imagen_id' => 'Imagen Id', 
		'galeria_id' => 'Galeria Id', 
        ];
    }
    
    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return ImagenGaleria
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }
    
    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return ImagenGaleria
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }
    
    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return ImagenGaleria
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    } 

    /**
     * Esta función retorna una instancia del modelo tbl_imagenes_galerias
     * @param string $clase
     * @return ImagenGaleria
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }
}