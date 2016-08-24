<?php

/**
 * Este modelo es la representación de la tabla tbl_roles
 *
 * Atributos del modelo
 * @property int $id_rol
 * @property string $nombre
 * @property string $descripcion
 * @property tinyint $desarrollador
 * 
 * Relaciones del modelo
 */
class Rol extends CModelo {

    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "roles";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_roles
     * @return array
     */
    public function atributos() {
        return [
            'id_rol' => ['pk'],
            'nombre',
            'descripcion',
            'desarrollador' => ['def' => '0'],
            'estado' => ['def' => '1'],
        ];
    }
    
    public function filtrosAjx() {
            return null;
    }

    public function filtros() {
        return ['requeridos' => 'nombre,desarrollador', 'seguros' => '*'];
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

    public function getEtiquetaEstado() {
        if ($this->estado == 1) {
            return CHtml::e('span', 'Activo', ['class' => 'label label-success']);
        } else {
            return CHtml::e('span', 'Inactivo', ['class' => 'label label-danger']);
        }
    }

    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
            'id_rol' => 'Rol',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripción',
            'desarrollador' => 'Desarrollador',
            'estado' => 'Estado',
        ];
    }

    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return Rol
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }

    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return Rol
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }

    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return Rol
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    }

    /**
     * Esta función retorna una instancia del modelo tbl_roles
     * @param string $clase
     * @return Rol
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }

}
