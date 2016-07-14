<?php

/**
 * Este modelo es la representación de la tabla tbl_categorias
 *
 * Atributos del modelo
 * @property int $id_categoria
 * @property string $nombre
 * @property string $descripcion
 * @property int $cupo_maximo
 * @property int $cupo_minimo
 * @property double $tarifa
 * @property int $edad_minima
 * @property int $edad_maxima
 * @property tinyint $estado
 * @property int $entrenador_id
 * 
 * Relaciones del modelo
 */
class Categoria extends CModelo {

    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "categorias";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_categorias
     * @return array
     */
    public function atributos() {
        return [
            'id_categoria' => ['pk'],
            'nombre',
            'descripcion',
            'cupo_maximo',
            'cupo_minimo',
            'tarifa',
            'edad_minima',
            'edad_maxima',
            'estado' => ['def' => '1'],
            'entrenador_id',
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
        ];
    }

    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
            'id_categoria' => 'Id Categoria',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'cupo_maximo' => 'Cupo Max.',
            'cupo_minimo' => 'Cupo Min.',
            'tarifa' => 'Tarifa',
            'edad_minima' => 'Edad Min.',
            'edad_maxima' => 'Edad Max.',
            'estado' => 'Estado',
            'entrenador_id' => 'Entrenador Id',
            'cupo_rango' => 'Cupo',
            'edad_rango' => 'Edad',
        ];
    }
    
    public function getEdadRango(){
        return $this->edad_minima . " - " . $this->edad_maxima;
    }
    
    public function getCupoRango(){
        return $this->cupo_minimo . ' - ' . $this->cupo_maximo;
    }
    
    public function getResumen() {
        return strlen($this->descripcion) > 50? 
               substr($this->descripcion, 0, 50) . '...' : $this->descripcion;
    }
    
    public function getMatriculados(){
        $matriculas = Matricula::modelo()->contar([
            'where' => "categoria_id=$this->id_categoria AND estado = 1",
        ]);        
        return $matriculas;
    }

    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return Categoria
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }

    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return Categoria
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }

    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return Categoria
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    }

    /**
     * Esta función retorna una instancia del modelo tbl_categorias
     * @param string $clase
     * @return Categoria
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }

}
