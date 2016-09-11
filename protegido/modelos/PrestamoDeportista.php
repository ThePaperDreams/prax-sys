<?php

/**
 * Este modelo es la representación de la tabla tbl_prestamos_deportista
 *
 * Atributos del modelo
 * @property int $id_prestamo
 * @property string $club_origen
 * @property string $club_destino
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property tinyint $estado
 * @property int $deportista_id
 * @property enum $tipo_prestamo
 * 
 * Relaciones del modelo
 * @property Deportista $Deportista
 */
class PrestamoDeportista extends CModelo {
    public $nombreDeportista;
    
    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "prestamos_deportista";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_prestamos_deportista
     * @return array
     */
    public function atributos() {
        return [
            'id_prestamo' => ['pk'],
            'club_origen',
            'club_destino',
            'fecha_inicio',
            'fecha_fin',
            'estado' => ['def' => '1'],
            'deportista_id',
            'tipo_prestamo',
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
        ];
    }

    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
            'id_prestamo' => 'Id Prestamo',
            'club_origen' => 'Club de origen',
            'club_destino' => 'Club de destino',
            'fecha_inicio' => 'Fecha inicio',
            'fecha_fin' => 'Fecha fin',
            'estado' => 'Estado',
            'deportista_id' => 'Deportista',
            'tipo_prestamo' => 'Tipo prestamo',
            'nombreDeportista' => 'Deportista',
            'etiquetaTipo' => 'Tipo',
        ];
    }
    
    public function filtrosAjx() {
        $criterio = new CCriterio();
        $concat = "CONCAT_WS(' ', nombre1, nombre2, apellido1, apellido2,t2.apellido2)";        
        $criterio->union("tbl_deportistas", "t2")
                ->donde("t.deportista_id", '=', "t2.id_deportista")
                ->condicion($concat, $this->deportista_id, 'LIKE')
                ->y("t.club_origen", $this->club_origen, 'LIKE')
                ->y("t.club_destino", $this->club_destino, 'LIKE')
                ->y("t.tipo_prestamo", $this->tipo_prestamo)
                ->y("t.fecha_inicio", $this->fecha_inicio)
                ->y("t.fecha_fin", $this->fecha_fin)
                ->orden("estado = 1", false)
                ->orden("id_prestamo", false);
        return $criterio;
    }
    
    public function filtros() {
        return [
            'requeridos' => 'club_origen,club_destino,fecha_inicio,fecha_fin,deportista_id,tipo_prestamo',
        ];
    }
    
    public function getEtiquetaTipo(){
        if($this->tipo_prestamo == 'salida'){
            return CHtml::e('span', 'Salida ' . CBoot::fa('arrow-circle-up'), ['class' => 'label label-danger']); 
        } else {
            return CHtml::e('span', 'Entrada ' . CBoot::fa('arrow-circle-down'), ['class' => 'label label-success']); 
        }
    }
    
    public function getEtiquetaEstado(){
        if($this->estado == 1){
            return CHtml::e('span', 'Activo', ['class' => 'label label-success']); 
        } else {
            return CHtml::e('span', 'Finalizado', ['class' => 'label label-default']); 
        }
    }

    public function getNombreDepCompleto(){
        return $this->Deportista->nombreCompleto;
    }
    
    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return PrestamoDeportista
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }

    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return PrestamoDeportista
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }

    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return PrestamoDeportista
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    }

    /**
     * Esta función retorna una instancia del modelo tbl_prestamos_deportista
     * @param string $clase
     * @return PrestamoDeportista
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }

}