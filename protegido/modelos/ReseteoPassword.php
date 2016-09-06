<?php
/**
 * Este modelo es la representación de la tabla tbl_reseteopass
 *
 * Atributos del modelo
 * @property int $id
 * @property int $idusuario
 * @property string $username
 * @property string $token
 * @property timestamp $creado
 * 
 * Relaciones del modelo
 */
 class ReseteoPassword extends CModelo{
 
    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "reseteopass";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_reseteopass
     * @return array
     */
    public function atributos() {
        return [
            'id' => ['pk'] ,
                'idusuario',
                'username',
                'token',
                'creado' => ['def' => 'CURRENT_TIMESTAMP'] ,
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
		'idusuario' => 'Idusuario', 
		'username' => 'Username', 
		'token' => 'Token', 
		'creado' => 'Creado', 
        ];
    }
    
    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return ReseteoPassword
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }
    
    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return ReseteoPassword
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }
    
    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return ReseteoPassword
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    } 

    /**
     * Esta función retorna una instancia del modelo tbl_reseteopass
     * @param string $clase
     * @return ReseteoPassword
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }
}