<?php

/**
 * Este modelo es la representación de la tabla tbl_deportistas
 *
 * Atributos del modelo
 * @property int $id_deportista
 * @property string $identificacion
 * @property string $nombre1
 * @property string $nombre2
 * @property string $apellido1
 * @property string $apellido2
 * @property string $direccion
 * @property string $foto
 * @property string $telefono1
 * @property string $telefono2
 * @property string $fecha_nacimiento
 * @property int $estado_id
 * @property int $tipo_documento_id
 * 
 * Relaciones del modelo
 * @property FkTblPersonasTblTiposDocumento $fkTblPersonasTblTiposDocumento
 * @property FkTblPersonasTblEstadoDeportistas1 $fkTblPersonasTblEstadoDeportistas1
 */
class Deportista extends CModelo {

    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "deportistas";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_deportistas
     * @return array
     */
    public function atributos() {
        return [
            'id_deportista' => ['pk'],
            'identificacion',
            'nombre1',
            'nombre2',
            'apellido1',
            'apellido2',
            'direccion',
            'foto',
            'telefono1',
            'telefono2',
            'fecha_nacimiento',
            'estado_id' => ['def' => '1'],
            'tipo_documento_id',
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
            'fkTblPersonasTblTiposDocumento' => [self::PERTENECE_A, 'FkTblPersonasTblTiposDocumento', 'tipo_documento_id'],
            'fkTblPersonasTblEstadoDeportistas1' => [self::PERTENECE_A, 'FkTblPersonasTblEstadoDeportistas1', 'estado_id'],
        ];
    }

    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
            'id_deportista' => 'Id Persona',
            'identificacion' => 'Identificacion',
            'nombre1' => 'Nombre1',
            'nombre2' => 'Nombre2',
            'apellido1' => 'Apellido1',
            'apellido2' => 'Apellido2',
            'direccion' => 'Direccion',
            'foto' => 'Foto',
            'telefono1' => 'Telefono1',
            'telefono2' => 'Telefono2',
            'fecha_nacimiento' => 'Fecha Nacimiento',
            'estado_id' => 'Estado Id',
            'tipo_documento_id' => 'Tipo Documento Id',
        ];
    }
    
    public function getNombreDePila(){
        return implode(' ', [$this->nombre1, $this->nombre2, $this->apellido1, $this->apellido2]);
    }
    
    public function getNombreIdentificacion(){
        return implode(' ', [$this->identificacion, $this->getNombreDePila()]);
    }

    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return Deportista
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }

    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return Deportista
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }

    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return Deportista
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    }

    /**
     * Esta función retorna una instancia del modelo tbl_deportistas
     * @param string $clase
     * @return Deportista
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }

}
