<?php
/**
 * Este modelo es la representación de la tabla tbl_rutas
 *
 * Atributos del modelo
 * @property int $id_ruta
 * @property string $nombre
 * @property string $ruta
 * @property int $modulo_id
 * 
 * Relaciones del modelo
 * @property Modulos[] $Modulos
 */
 class Ruta extends CModelo{
 
    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "rutas";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_rutas
     * @return array
     */
    public function atributos() {
        return [
		'id_ruta' => ['pk'] , 
		'nombre', 
		'ruta', 
		'modulo_id', 
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
            	'Modulo' => [self::PERTENECE_A, 'Modulo', 'modulo_id'],
        ];
    }
    
    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
		'id_ruta' => 'Ruta', 
		'nombre' => 'Nombre', 
		'ruta' => 'Ruta', 
		'modulo_id' => 'Módulo', 
        ];
    }
    
    public function filtros(){
        return [
            'requeridos' => 'nombre,ruta,modulo_id',
            'seguros' => '*',
        ];
    }
        
    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return Ruta
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }
    
    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return Ruta
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }
    
    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return Ruta
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    } 

    /**
     * Esta función retorna una instancia del modelo tbl_rutas
     * @param string $clase
     * @return Ruta
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }
}
