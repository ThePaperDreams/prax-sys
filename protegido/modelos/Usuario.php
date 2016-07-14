<?php

/**
 * Este modelo es la representación de la tabla tbl_usuarios
 *
 * Atributos del modelo
 * @property int $id_usuario
 * @property int $rol_id
 * @property string $email
 * @property string $nombre_usuario
 * @property string $nombres
 * @property string $apellidos
 * @property string $telefono
 * @property string $clave
 * @property tinyint $recuperacion
 * @property tinyint $estado
 * 
 * Relaciones del modelo
 * @property FkTblUsuariosTblRoles1 $fkTblUsuariosTblRoles1
 */
class Usuario extends CModelo {

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
            'id_usuario' => ['pk'],
            'rol_id',
            'email',
            'nombre_usuario',
            'nombres',
            'apellidos',
            'telefono',
            'clave',
            'recuperacion',
            'estado' => ['def' => '1'],
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
            'fkTblUsuariosTblRoles1' => [self::PERTENECE_A, 'FkTblUsuariosTblRoles1', 'rol_id'],
        ];
    }

    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
            'id_usuario' => 'Id Usuario',
            'rol_id' => 'Rol Id',
            'email' => 'Email',
            'nombre_usuario' => 'Nombre Usuario',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'telefono' => 'Telefono',
            'clave' => 'Clave',
            'recuperacion' => 'Recuperacion',
            'estado' => 'Estado',
        ];
    }

    public function getNombreMasUsuario(){
        return $this->nombres . ' ' . $this->apellidos . " ($this->nombre_usuario)";
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
