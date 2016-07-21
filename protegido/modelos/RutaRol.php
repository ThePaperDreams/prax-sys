<?php

/**
 * Este modelo es la representación de la tabla tbl_rutas_x_rol
 *
 * Atributos del modelo
 * @property int $id_rxr
 * @property int $rol_id
 * @property int $ruta_id
 * @property tinyint $estado
 * 
 * Relaciones del modelo
 * @property Rol $Rol
 * @property Ruta $Ruta
 */
class RutaRol extends CModelo {

    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "rutas_x_rol";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_rutas_x_rol
     * @return array
     */
    public function atributos() {
        return [
            'id_rxr' => ['pk'],
            'rol_id',
            'ruta_id',
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
            'Ruta' => [self::PERTENECE_A, 'Ruta', 'ruta_id'],
            'Rol' => [self::PERTENECE_A, 'Rol', 'rol_id'],
        ];
    }

    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
            'id_rxr' => 'Id',
            'rol_id' => 'Rol',
            'ruta_id' => 'Ruta',
            'estado' => 'Estado',
        ];
    }

    public function filtros() {
        return ['requeridos' => 'rol_id,ruta_id,estado'];
    }

    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return RutaRol
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }

    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return RutaRol
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }

    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return RutaRol
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    }

    /**
     * Esta función retorna una instancia del modelo tbl_rutas_x_rol
     * @param string $clase
     * @return RutaRol
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }

}
