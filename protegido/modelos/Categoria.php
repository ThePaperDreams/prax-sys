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
 * @property boolean $enUso
 * 
 * Relaciones del modelo
 * @property Usuario $usuario
 */
class Categoria extends CModelo {
    private $enUso = null;
    public $cupos;
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
            'cupo_maximo' => ['def' => '0'],
            'cupo_minimo' => ['def' => '0'],
            'tarifa' => ['def' => '0'],
            'edad_minima' => ['def' => '0'],
            'edad_maxima' => ['def' => '0'],
            'estado' => ['def' => '1'],
            'entrenador_id',
        ];
    }
    
    public function filtros() {
        return [
            'requeridos' => 'nombre,cupo_minimo,cupo_maximo,edad_minima,edad_maxima',
        ];
    }
    
    public function filtrosAjx() {
        $criterio = new CCriterio();
        $criterio->condicion("t.nombre", $this->nombre);
        $criterio->condicion("t.tarifa", $this->tarifa);
        $criterio->condicion("t.estado", $this->estado);
        return $criterio;
    }
    
    public function antesDeGuardar() {
        if($this->tarifa == ""){ $this->tarifa = 0; }
    }

    /**
     * Esta función retorna las relaciones con otros modelos
     * @return array
     */
    protected function relaciones() {
        return [
                # el formato es simple: 
                # tipo de relación | modelo con que se relaciona | campo clave foranea
            'Entrenador' => [self::PERTENECE_A, 'Usuario', 'entrenador_id'],
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
            'cupo_maximo' => 'Cupo máximo',
            'cupo_minimo' => 'Cupo mínimo',
            'tarifa' => 'Tarifa',
            'edad_minima' => 'Edad mínima',
            'edad_maxima' => 'Edad máxima',
            'estado' => 'Estado',
            'entrenador_id' => 'Entrenador',
            'edad' => 'Edades',
            'cupos' => 'Cupos',
            'tarifaf' => 'Tarifa',
        ];
    }
    
    public function getEnUso(){
        if($this->enUso == null){
            $condicion = (['where' => "categoria_id = $this->id_categoria"]);
            $matriculas = Matricula::modelo()->contar($condicion);
            $planes = PlanTrabajo::modelo()->contar($condicion);
            $this->enUso = $planes > 0 || $matriculas > 0;
        }
        return $this->enUso;        
    }
    
    public function getTarifaF(){
        return "$ " . number_format($this->tarifa);
    }

    public function getEdad() {
        return "$this->edad_minima - $this->edad_maxima";
    }

    public function getCupos() {
        return "$this->cupo_minimo - $this->cupo_maximo";
    }

    public function getEtiquetaEstado(){
        if($this->estado == 0){
            return CHtml::e('span', 'Inactivo', ['class' => 'label label-default']); 
        } else if($this->estado == 1){
            return CHtml::e('span', 'Activo', ['class' => 'label label-success']); 
        }
    }
    
    /**
     * 
     * @return Matricula
     */
    public function getMatriculados(){
        $matriculas = Matricula::modelo()->contar([
            'where' => "categoria_id=$this->id_categoria AND estado = 1",
        ]);
        return $matriculas;
    }
    /**
     * 
     */
    public function getDeportistasMatriculados(){
        $matriculas = Matricula::modelo()->listar([
            'where' => "categoria_id=$this->id_categoria AND estado = 1",
        ]);
        $deportistas = [];
        foreach($matriculas AS $mat){ $deportistas[] = $mat->Deportista; }
        return $deportistas;
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
