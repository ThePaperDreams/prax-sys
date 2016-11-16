<?php
/**
 * Este modelo es la representación de la tabla tbl_configuraciones
 *
 * Atributos del modelo
 * @property int $id
 * @property string $nombre
 * @property string $valor
 * 
 * Relaciones del modelo
 */
class Configuracion extends CModelo{

    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "configuraciones";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_configuraciones
     * @return array
     */
    public function atributos() {
        return [
        'id' => ['pk'] ,
        'nombre',
        'valor',
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
        'valor' => 'Valor', 
        ];
    }
    
    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return Configuracion
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }

    public static function get($nombre, $modelo = false){
        $c = new CCriterio();
        $c->condicion("nombre", $nombre);
        $config = self::modelo()->primer($c);
        if($modelo){ return $config; }
        return $config !== null? $config->valor : "";
    }

    public static function set($nombre, $valor){
        $c = new CCriterio();
        $c->condicion("nombre", $nombre);
        $config = self::modelo()->primer($c);
        if($config !== null){
            $config->valor = $valor;
            return $config->guardar();
        } else {
            return null;
        }
    }
    
    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return Configuracion
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }
    
    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return Configuracion
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    } 

    /**
     * Esta función retorna una instancia del modelo tbl_configuraciones
     * @param string $clase
     * @return Configuracion
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }
}