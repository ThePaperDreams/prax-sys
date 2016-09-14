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
 * @property string $foto
 * 
 * Relaciones del modelo
 * @property Rol $Rol
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
            'foto',
        ];
    }
    
    public function filtros() {
        return [
            'requeridos' => 'rol_id,email,nombre_usuario,nombres,apellidos,clave',
            'seguros'=>'*',
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
            'Rol' => [self::PERTENECE_A, 'Rol', 'rol_id'],
        ];
    }

    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
            'id_usuario' => 'Usuario',
            'rol_id' => 'Rol',
            'email' => 'Email',
            'nombre_usuario' => 'Nombre Usuario',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'telefono' => 'Teléfono',
            'clave' => 'Clave',
            'recuperacion' => 'Recuperación',
            'estado' => 'Estado',
            'foto' => 'Foto',
        ];
    }
    
    public function filtrosAjx() {
        $criterio = new CCriterio();
        $criterio->condicion("t.nombres", $this->nombres, "LIKE")
                ->y("t.apellidos", $this->apellidos, "LIKE")                
                ->y("t.email", $this->email, "LIKE")                
                ->y("t.estado", $this->estado, "=")
                ->orden("t.estado", "DESC");
        return $criterio;
    }
    
    public function getNombreCompleto(){
        return $this->nombres . " " . $this->apellidos;
    }
    
    public function getNombreMasUsuario(){
        return $this->nombres . ' ' . $this->apellidos . " ($this->nombre_usuario)";
    }
    
    public function getEtiquetaEstado(){
        if($this->estado == 1){
            return CHtml::e('span', 'Activo', ['class' => 'label label-success']);
        } else if($this->estado == 0){
            return CHtml::e('span', 'Inactivo', ['class' => 'label label-danger']);
        }
    }
    
    public function getFotoUrl(){
        $url = Sis::UrlBase() . 'publico/imagenes/usuarios/';
        if($this->foto !== "" && $this->foto !== null){
            return $url . $this->foto;
        } else {
           return $url . 'developer.png';
        }
    }
    
    public function getFotoAsignada() {
        $url = Sis::UrlBase() . 'publico/imagenes/usuarios/';
        if($this->foto !== "" && $this->foto !== null){
            return CHtml::img($url . $this->foto.'?t='.  time(),[ 'class'=>'img-rounded', 'id' => 'actualfoto']);           
        } else {
           return CHtml::img($url . 'developer.png',['class'=>'img-rounded']);
        }
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
