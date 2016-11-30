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
        $criterio = new CCriterio();
        $criterio->condicion("nombre", $this->nombre, "LIKE")->y("estado", $this->estado, "=");
        return $criterio;                
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

    public static function getPermisos($modulo, $rol){
        $query = "SELECT
                    t.id_rxr,
                    t.rol_id,
                    t2.id_ruta,
                    t3.nombre nombre_rol,
                    (CASE WHEN t.rol_id = '" . $rol . "' THEN t.estado ELSE 0 END) as estado, 
                    t2.nombre nombre_ruta,
                    t2.ruta,
                    t2.modulo_id
            FROM
                    tbl_rutas_x_rol t
            RIGHT JOIN tbl_rutas t2 ON t2.id_ruta = t.ruta_id
            LEFT JOIN tbl_roles t3 ON t3.id_rol = t.rol_id
            WHERE (t.rol_id IS NULL OR t.rol_id = '" . $rol . "' OR t.rol_id <> '" . $rol . "') AND 
         t2.modulo_id = '" . $modulo . "'";
        $resultados = Sis::apl()->bd->ejecutarComando($query, true);
        return $resultados;
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
