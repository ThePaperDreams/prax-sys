<?php

/**
 * Este modelo es la representación de la tabla tbl_salidas
 *
 * Atributos del modelo
 * @property int $id_salida
 * @property int $cantidad
 * @property datetime $fecha_realizacion
 * @property datetime $fecha_entrega
 * @property string $descripcion
 * @property int $responsable_id
 * @property tinyint $estado
 * 
 * Relaciones del modelo
 * @property SalidaImplemento[] $Detalles
 */
class Salida extends CModelo {

    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "salidas";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_salidas
     * @return array
     */
    public function atributos() {
        return [
            'id_salida' => ['pk'],
            'fecha_realizacion',
            'fecha_entrega',
            'descripcion',
            'responsable_id',
            'estado' => ['def' => '1'],
        ];
    }

    public function filtros() {
        return [
            'requeridos' => 'fecha_realizacion,fecha_entrega,responsable_id,estado',
            'seguros'=>'*',
        ];
    }

    public function filtrosAjx() {
        $criterio = new CCriterio();
        $concat = "CONCAT_WS(' ',t.fecha_entrega, t.fecha_realizacion, t.estado, t1.nombres)";
        $criterio->union("tbl_usuarios", "t1")
           ->donde("t1.id_usuario", "=", "t.responsable_id")
           ->condicion($concat, $this->responsable_id, "LIKE")
           ->y("t.estado", $this->estado, "=")
           ->y("t.fecha_realizacion", $this->fecha_realizacion, "LIKE")
           ->y("t.fecha_entrega", $this->fecha_entrega, "LIKE");
       return $criterio;
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
            'Detalles' => [
                self::CONTENGAN_A, 'SalidaImplemento', 'salida_id'
            ]
        ];
    }

    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
            'id_salida' => 'Id Salida',
            'fecha_realizacion' => 'Fecha Realizacion',
            'fecha_entrega' => 'Fecha Entrega',
            'descripcion' => 'Descripción',
            'responsable_id' => 'Responsable',
            'estado' => 'Estado',
        ];
    }

    public function getEtiquetaEstado() {
        if ($this->estado == 1) {
            return CHtml::e('span', 'Activo', ['class' => 'label label-success']);
        } else if ($this->estado == 0) {
            return CHtml::e('span', 'Inactivo', ['class' => 'label label-danger']);
        }  else if ($this->estado == 2) {
            return CHtml::e('span', 'Devuelto', ['class' => 'label label-info']);
        }
        
    }

    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return Salida
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }

    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return Salida
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }

    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return Salida
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    }

    /**
     * Esta función retorna una instancia del modelo tbl_salidas
     * @param string $clase
     * @return Salida
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }

}
