<?php

/**
 * Este modelo es la representación de la tabla tbl_fichas_tecnicas
 *
 * Atributos del modelo
 * @property int $id_ficha_tecnica
 * @property int $amonestacion
 * @property int $dorsal
 * @property int $expulsion
 * @property string $fecha_actualizacion
 * @property float $peso
 * @property tinyint $pierna_habil
 * @property int $entrenador_id
 * @property float $talla
 * @property float $valoracion
 * @property string $rh
 * @property int $deportista_id
 * @property string lesiones
 * 
 * Relaciones del modelo
 * @property FkTblFichasTecnicasTblPersonas1 $fkTblFichasTecnicasTblPersonas1
 * @property Seguimiento[] $seguimientosPositivos
 * @property Seguimiento[] $seguimientosNegativos
 * @property FichaPosicion[] $Posiciones
 */
class FichaTecnica extends CModelo {
    private $seguimientosPositivos = null;
    private $seguimientosNegativos = null;
    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "fichas_tecnicas";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_fichas_tecnicas
     * @return array
     */
    public function atributos() {
        return [
            'id_ficha_tecnica' => ['pk'],
            'amonestacion' => ['def' => '0'],
            'dorsal',
            'expulsion',
            'fecha_actualizacion',
            'peso',
            'pierna_habil',
            'entrenador_id',
            'talla',
            'valoracion',
            'rh',
            'deportista_id',
            'lesiones',
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
            'Deportista' => [self::PERTENECE_A, 'Deportista', 'deportista_id'],
            'Posiciones' => [self::CONTENGAN_A, 'FichaPosicion', 'ficha_id'],
        ];
    }
    
    public function getPos(){
        $posiciones = $this->Posiciones;
        $pos = [];
        foreach ($posiciones AS $p){
            $pos[] = $this->getPosLabel($p->Posicion->posicion, $p->Posicion->abreviatura);
        }
        if(count($pos) === 0){
            return CHtml::e('span', "Sin definir", ['class' => 'label label-default']);
        }
        return implode(', ', $pos);
    }   
    
    private function getPosLabel($txt, $abr){
        return CHtml::e('span', $txt, ['class' => 'label label-default']);
    }

    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
            'id_ficha_tecnica' => 'Id Ficha Tecnica',
            'amonestacion' => 'Amonestacion',
            'dorsal' => 'Dorsal',
            'expulsion' => 'Expulsion',
            'fecha_actualizacion' => 'Fecha Actualizacion',
            'peso' => 'Peso',
            'pierna_habil' => 'Pierna Habil',
            'entrenador_id' => 'Entrenador Id',
            'talla' => 'Talla',
            'valoracion' => 'Valoracion',
            'rh' => 'Rh',
            'deportista_id' => 'Deportista Id',
            'lesiones' => 'Lesiones',
        ];
    }
    
    
    public function getSeguimientosPositivos(){
        if($this->seguimientosPositivos === null){
            $this->seguimientosPositivos = Seguimiento::modelo()->listar([
                'where' => "tipo_seguimiento=0 AND ficha_tecnica_id = $this->id_ficha_tecnica",
                'order' => "fecha  DESC, id_seguimiento DESC",
            ]);
        }
        return $this->seguimientosPositivos;
    }
    
    public function getSeguimientosNegativos(){
        if($this->seguimientosNegativos === null){
            $this->seguimientosNegativos = Seguimiento::modelo()->listar([
                    'where' => "tipo_seguimiento=1 AND ficha_tecnica_id = $this->id_ficha_tecnica",
                    'order' => "fecha  DESC, id_seguimiento DESC",
                ]);
        }
        return $this->seguimientosNegativos;
    }
    
    public function getPiernaStr(){
        if($this->pierna_habil == 0){
            return "Izquierda";
        } else if($this->pierna_habil == 1){
            return "Derecha";
        } else {
            return "Ambas";
        }
    }

    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return FichaTecnica
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }

    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return FichaTecnica
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }

    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return FichaTecnica
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    }

    /**
     * Esta función retorna una instancia del modelo tbl_fichas_tecnicas
     * @param string $clase
     * @return FichaTecnica
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }

}
