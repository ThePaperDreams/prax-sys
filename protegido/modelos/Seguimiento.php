<?php

/**
 * Este modelo es la representación de la tabla tbl_seguimientos
 *
 * Atributos del modelo
 * @property int $id_seguimiento
 * @property int $tipo_seguimiento
 * @property int $estado
 * @property int $evaluacion
 * @property string $fecha
 * @property string $descripcion
 * @property int $ficha_tecnica_id
 * 
 * Relaciones del modelo
 * @property FkTblSeguimientosTblFichasTecnicas1 $fkTblSeguimientosTblFichasTecnicas1
 */
class Seguimiento extends CModelo {

    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "seguimientos";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_seguimientos
     * @return array
     */
    public function atributos() {
        return [
            'id_seguimiento' => ['pk'],
            'tipo_seguimiento',
            'estado' => ['def' => '1'],
            'evaluacion',
            'fecha',
            'descripcion',
            'ficha_tecnica_id',
            'realizado_por',
        ];
    }
    
    public function antesDeGuardar() {
        if($this->nuevo){
            $this->realizado_por = Sis::apl()->usuario->getID();
            $this->fecha = date("Y-m-d");
        }
    }

    /**
     * Esta función retorna las relaciones con otros modelos
     * @return array
     */
    protected function relaciones() {
        return [
            # el formato es simple: 
            # tipo de relación | modelo con que se relaciona | campo clave foranea
            'fkTblSeguimientosTblFichasTecnicas1' => [self::PERTENECE_A, 'FkTblSeguimientosTblFichasTecnicas1', 'ficha_tecnica_id'],
        ];
    }

    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
            'id_seguimiento' => 'ID',
            'tipo_seguimiento' => 'Tipo de Seguimiento',
            'estado' => 'Estado',
            'evaluacion' => 'Calificación',
            'fecha' => 'Fecha',
            'descripcion' => 'Descripción',
            'ficha_tecnica_id' => 'Ficha Tecnica',
        ];
    }

    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return Seguimiento
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }

    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return Seguimiento
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }

    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return Seguimiento
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    }

    /**
     * Esta función retorna una instancia del modelo tbl_seguimientos
     * @param string $clase
     * @return Seguimiento
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }

}
