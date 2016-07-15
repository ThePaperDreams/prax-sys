<?php
/**
 * Este modelo es la representación de la tabla tbl_usuarios
 *
 * Atributos del modelo
 * @property int $id_usuarios
 * @property int $rol_id
 * @property string $email
 * @property string $nombre
 * @property string $clave
 * @property tinyint $recuperacion
 * @property int $persona_id
 * 
 * Relaciones del modelo
 * @property FkTblUsuariosTblPersonas1 $fkTblUsuariosTblPersonas1
 * @property FkTblUsuariosTblRoles1 $fkTblUsuariosTblRoles1
 */
 class Usuario extends CModelo{
 
    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "usuarios";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_usuarios
     * @return array
     */
    public function atributos() {
        return [
            'id_usuarios' => ['pk'] ,
                'rol_id',
                'email',
                'nombre',
                'clave',
                'recuperacion',
                'persona_id',
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
            	'fkTblUsuariosTblPersonas1' => [self::PERTENECE_A, 'FkTblUsuariosTblPersonas1', 'persona_id'],
	'fkTblUsuariosTblRoles1' => [self::PERTENECE_A, 'FkTblUsuariosTblRoles1', 'rol_id'],
        ];
    }
    
    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
		'id_usuarios' => 'Id Usuarios', 
		'rol_id' => 'Rol', 
		'email' => 'Email', 
		'nombre' => 'Nombre', 
		'clave' => 'Clave', 
		'recuperacion' => 'Recuperación', 
		'persona_id' => 'Persona', 
        ];
    }
    
    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return Usuario
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }
    
    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return Usuario
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }
    
    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return Usuario
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    } 

    /**
     * Esta función retorna una instancia del modelo tbl_usuarios
     * @param string $clase
     * @return Usuario
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }
}