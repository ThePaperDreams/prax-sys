<?php

/**
 * Este modelo es la representación de la tabla tbl_equipos
 *
 * Atributos del modelo
 * @property string nombre
 * @property int $id_equipo
 * @property int $cupo_maximo
 * @property int $cupo_minimo
 * @property int $estado
 * @property int $posicion
 * @property int $entrenador_id
 * @property int $deportista_id
 * 
 * Relaciones del modelo
 * @property DeportistaEquipo[] $DllDeportistas
 * @property DeportistaEquipo[] $JugadoresE
 * @property Usuario $Entrenador
 */
class Equipo extends CModelo {

    private $_deportistas = null;
    private $_totalJugadores = null;

    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "equipos";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_equipos
     * @return array
     */
    public function atributos() {
        return [
            'id_equipo' => ['pk'],
            'nombre',
            'cupo_maximo',
            'cupo_minimo',
            'estado' => ['def' => '1'],
            'posicion',
            'entrenador_id',
            'torneo_id'
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
            'Entrenador' => [self::PERTENECE_A, 'Usuario', 'entrenador_id'],
            'DllDeportistas' => [self::CONTENGAN_A, 'DeportistaEquipo', 'equipo_id'],
            'mTorneo' => [self::PERTENECE_A, 'Torneo', 'torneo_id'],
            'JugadoresE' => [self::CONTENGAN_A, 'DeportistaEquipo', 'equipo_id'],
        ];
    }

    public function getDeportistas() {
        if ($this->_deportistas == null) {
            $this->_deportistas = [];
            $dllDeportista = $this->DllDeportistas;
            foreach ($dllDeportista AS $d) {
                $this->_deportistas[] = $d->Deportista;
            }
        }
        return $this->_deportistas;
    }

    public function antesDeGuardar() {
        $this->cupo_minimo = 0;
    }
    
    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
            'id_equipo' => 'Id Equipo',
            'nombre' => 'Nombre',
            'cupo_maximo' => 'Cupo Máximo',
            'cupo_minimo' => 'Cupo Mínimo',
            'estado' => 'Estado',
            'posicion' => 'Posición',
            'entrenador_id' => 'Entrenador',
            'deportista_id' => 'Deportistas',
            'torneo_id' => 'Torneo',
        ];
    }

    public function filtros() {
        return [
            'requeridos' => 'nombre,cupo_maximo, cupo_minimo, entrenador_id',
            'seguros' => '*',
        ];
    }

    public function filtrosAjx() {
        $criterio = new CCriterio();
        $criterio->condicion("nombre", $this->nombre, "LIKE")
                ->y("cupo_minimo", $this->cupo_minimo, "=")
                ->y("cupo_maximo", $this->cupo_maximo, "=")
                ->y("posicion", $this->posicion, "=");
        return $criterio;
    }

    public function getEstadoEtiqueta() {
        if ($this->estado == 0) {
            return CHtml::e('span', 'Inactivo', ['class' => 'label label-danger']);
        } else {
            return CHtml::e('span', 'Activo', ['class' => 'label label-success']);
        }
    }

    public function getTotalJugadores() {
        if($this->_totalJugadores === null){
            $this->_totalJugadores = intval(count($this->JugadoresE));
        }
        return $this->_totalJugadores;
    }

    public function getTxtPos() {
        if ($this->posicion == null) {
            return 'Sin definir';
        }
        return $this->posicion;
    }

    /* public function getMDeportistas(){
      $deportista = $this->Deportista;
      $jugadores = [];
      foreach ($deportista AS $d){
      $jugadores[] = $d->jugador;
      }
      return $jugadores;
      } */

    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return Equipo
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }

    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return Equipo
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }

    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return Equipo
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    }

    /**
     * Esta función retorna una instancia del modelo tbl_equipos
     * @param string $clase
     * @return Equipo
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }

}
