<?php

/**
 * Este modelo es la representación de la tabla tbl_planes_trabajo
 *
 * Atributos del modelo
 * @property int $id_plan_trabajo
 * @property string $descripcion
 * @property string $fecha_aplicacion
 * @property tinyint $estado
 * @property int $categoria_id
 * 
 * Relaciones del modelo
 * @property ObjetivoPlan[] $Detalles
 * @property Categoria $Categoria
 */
class PlanTrabajo extends CModelo {

    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "planes_trabajo";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_planes_trabajo
     * @return array
     */
    public function atributos() {
        return [
            'id_plan_trabajo' => ['pk'],
            'descripcion',
            'fecha_aplicacion',
            'estado' => ['def' => '1'],
            'categoria_id',
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
            'Categoria' => [self::PERTENECE_A, 'Categoria', 'categoria_id'],
            'Detalles' => [self::CONTENGAN_A, 'ObjetivoPlan', 'plan_id'],
        ];
    }

    public function filtrosAjx() {
        $c = new CCriterio();
        $c->condicion("t.fecha_aplicacion", $this->fecha_aplicacion)
                ->y("t.estado", $this->estado)
                ->y("t.descripcion", $this->descripcion, 'LIKE')
                ->orden("t.estado = 1", false);
        return $c;
    }
        
    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
            'id_plan_trabajo' => 'Id',
            'descripcion' => 'Descripción',
            'fecha_aplicacion' => 'Fecha aplicación',
            'estado' => 'Estado',
            'categoria_id' => 'Categoría',
            'total_objetivos' => 'Objetivos',
        ];
    }
    
    public function filtros() {
        return [
            'requeridos' => 'descripcion,fecha_aplicacion,categoria_id',
            'seguros' => '*',
        ];
    }

    public function getEstadoEtiqueta(){
        if($this->estado == 0){
            return CHtml::e('span', 'Eliminado', ['class' => 'label label-danger']);
        } else {
            return CHtml::e('span', 'Activo', ['class' => 'label label-success']);
        }
    }    
    
    public function getResumen(){
        if(strlen($this->descripcion) > 50){
            return substr($this->descripcion, 0, 50) . ' [...]';
        } else {
            return $this->descripcion;
        }
    }
    
    public function getTotalObjetivos(){
        return count($this->Detalles);
    }
    
    public function getMDetalles(){
        $detalles = $this->Detalles;
        $objetivos = [];
        foreach ($detalles AS $d){
            $objetivos[] = $d->Objetivo;
        }
        return $objetivos;
    }
    
    public function idsObjetivos(){
        $detalles = $this->Detalles;
        $ids = [];
        foreach($detalles AS $d){
            $ids[] = $d->objetivo_id;
        }
        return $ids;
    }
    
    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return PlanTrabajo
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }

    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return PlanTrabajo
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }

    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return PlanTrabajo
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    }

    /**
     * Esta función retorna una instancia del modelo tbl_planes_trabajo
     * @param string $clase
     * @return PlanTrabajo
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }

}
