<?php

/**
 * Este modelo es la representación de la tabla tbl_entradas
 *
 * Atributos del modelo
 * @property int $id_entrada
 * @property datetime $fecha_realizacion
 * @property string $descripcion
 * @property int $responsable_id
 * @property tinyint $estado
 * 
 * Relaciones del modelo
 */
class Entrada extends CModelo {
    private $_resumen = null;
    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "entradas";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_entradas
     * @return array
     */
    public function atributos() {
        return [
            'id_entrada' => ['pk'],
            'fecha_realizacion',
            'descripcion',
            'responsable_id',
            'estado' => ['def' => 1],
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
            'Usuario' => [self::PERTENECE_A, 'Usuario', 'responsable_id'],
            'Detalles' => [self::CONTENGAN_A, 'EntradaImplemento', 'entrada_id'],
        ];
    }

    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
            'id_entrada' => 'Id Entrada',
            'fecha_realizacion' => 'Fecha Realizacion',
            'descripcion' => 'Descripcion',
            'responsable_id' => 'Responsable',
            'estado' => 'Estado',
        ];
    }

    public function getEtiquetaEstado() {
        if ($this->estado == 1) {
            return CHtml::e('span', 'Activo', ['class' => 'label label-success']);
        } else if($this->estado == 0) {
            return CHtml::e('span', 'Anulado', ['class' => 'label label-danger']);
        }
    }

    public function filtros() {
        return [
            'requeridos' => 'fecha_realizacion,responsable_id,estado',
            'seguros'=>'*',
        ];
    }

    public function filtrosAjx() {
        $criterio = new CCriterio();
        $concat = "CONCAT_WS(' ',t1.nombres)";
        $criterio->union("tbl_usuarios", "t1")
           ->donde("t1.id_usuario", "=", "t.responsable_id")
           ->condicion($concat, $this->responsable_id, "LIKE")
           ->y("t.estado", $this->estado, "=")
           ->y("t.fecha_realizacion", $this->fecha_realizacion, "LIKE")
           ->orden('t.fecha_realizacion', false);
       return $criterio;
    }

    public function getResumen(){
        if($this->_resumen == null){
            $this->_resumen = strlen($this->descripcion) > 50? 
                substr($this->descripcion, 0, 50) . '...' : $this->descripcion;
        }
        return $this->_resumen;
    }

    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return Entrada
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }

    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return Entrada
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }

    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return Entrada
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    }

    /**
     * Esta función retorna una instancia del modelo tbl_entradas
     * @param string $clase
     * @return Entrada
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }

}
