<?php

/**
 * Este modelo es la representación de la tabla tbl_asistencia
 *
 * Atributos del modelo
 * @property int $id_asistencia
 * @property string $fecha
 * @property string $novedad
 * @property int $realizada_por
 * @property int $categoria_id
 * 
 * Relaciones del modelo
 * @property Usuario $Usuario
 */
class Asistencia extends CModelo {

    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "asistencia";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_asistencia
     * @return array
     */
    public function atributos() {
        return [
            'id_asistencia' => ['pk'],
            'fecha',
            'novedad',
            'realizada_por',
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
            'Usuario' => [self::PERTENECE_A, 'Usuario', 'realizada_por'],
        ];
    }

    public function filtros() {
        return [
            'requeridos' => 'fecha,categoria_id',
            'seguros' => 'fecha,novedad',   
        ];
    }
    
    public function filtrosAjx() {
        $criterio = new CCriterio();
        $criterio->condicion("t.fecha", $this->fecha)
            ->y("t.novedad", $this->novedad, 'LIKE')
            ->y("t.categoria_id", $this->categoria_id)
            ->y("t.realizada_por", $this->realizada_por)
            ->orden("t.fecha", false);
        return $criterio;
    }
    
    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
            'id_asistencia' => 'Asistencia',
            'fecha' => 'Fecha',
            'novedad' => 'Novedad',
            'realizada_por' => 'Realizada Por',
            'categoria_id' => 'Categoria',
        ];
    }
    
    public function antesDeGuardar() {
        if($this->nuevo){
            # asignamos el id del usuario logueado
            $this->realizada_por = Sis::Usuario()->getID();
        }
    }
    
    public function getFaltas(){
        $consulta = "SELECT " .
                    "t.id_matricula, " .
                    "t.categoria_id, " .
                    "t3.identificacion, " .
                    "CONCAT_WS(' ', t3.nombre1, t3.nombre2, t3.apellido1, t3.apellido2) AS nombre_completo, " .
                    "t3.nombre1, t3.nombre2, t3.apellido1, t3.apellido2, " .
                    "t.fecha_realizacion AS fecha_matricula, " .
                    "t2.asistencia_id, " .
                    "t4.fecha AS fecha_asistencia, " .
                    "t2.id AS id_fm, " .
                    "t2.justificacion " .
            "FROM " .
                    "tbl_matriculas t " .
            "LEFT JOIN tbl_faltas_x_matriculas t2 ON (t2.matricula_id = t.id_matricula AND t2.asistencia_id = $this->id_asistencia) " .
            "LEFT JOIN tbl_asistencia t4 ON t4.id_asistencia = t2.asistencia_id " .
            "LEFT JOIN tbl_deportistas t3 ON t3.id_deportista = t.deportista_id " .
            "WHERE t.estado = 1 AND t.categoria_id = t4.categoria_id " . 
            "ORDER BY t2.asistencia_id IS NULL ASC, t.fecha_realizacion < '$this->fecha' DESC, t.id_matricula";
        $resultados = Sis::apl()->bd->ejecutarComando($consulta, true);
        return $resultados;
    }
    
    public function validarFechaMatricula($fecha){
        $fechaAsistencia = strtotime($this->fecha);
        $fechaMatricula = strtotime($fecha);
        return $fechaMatricula < $fechaAsistencia;
    }

    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return Asistencia
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }

    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return Asistencia
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }

    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return Asistencia
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    }

    /**
     * Esta función retorna una instancia del modelo tbl_asistencia
     * @param string $clase
     * @return Asistencia
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }

}
