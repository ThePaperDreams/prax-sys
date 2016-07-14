<?php
/**
 * Este modelo es la representación de la tabla tbl_faltas_x_matriculas
 *
 * Atributos del modelo
 * @property int $id
 * @property int $matricula_id
 * @property int $asistencia_id
 * @property string $justificacion
 * 
 * Relaciones del modelo
 * @property FkTblFaltasXMatriculasTblMatriculas1 $fkTblFaltasXMatriculasTblMatriculas1
 * @property FkTblFaltasXMatriculasTblAsistencia1 $fkTblFaltasXMatriculasTblAsistencia1
 */
 class FaltaMatricula extends CModelo{
 
    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "faltas_x_matriculas";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_faltas_x_matriculas
     * @return array
     */
    public function atributos() {
        return [
            'id' => ['pk'] ,
                'matricula_id',
                'asistencia_id',
                'justificacion',
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
            	'fkTblFaltasXMatriculasTblMatriculas1' => [self::PERTENECE_A, 'FkTblFaltasXMatriculasTblMatriculas1', 'matricula_id'],
	'fkTblFaltasXMatriculasTblAsistencia1' => [self::PERTENECE_A, 'FkTblFaltasXMatriculasTblAsistencia1', 'asistencia_id'],
        ];
    }
    
    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
		'id' => 'Id', 
		'matricula_id' => 'Matricula Id', 
		'asistencia_id' => 'Asistencia Id', 
		'justificacion' => 'Justificacion', 
        ];
    }
    
    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return FaltaMatricula
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }
    
    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return FaltaMatricula
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }
    
    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return FaltaMatricula
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    } 

    /**
     * Esta función retorna una instancia del modelo tbl_faltas_x_matriculas
     * @param string $clase
     * @return FaltaMatricula
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }
}