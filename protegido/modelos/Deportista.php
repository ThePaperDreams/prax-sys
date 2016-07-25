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
 * @property EstadoDeportista $EstadoDeportista
 * @property TipoIdentificacion $TipoIdentificacion
 * @property Documento[] $Documento
 * @property Acudiente[] $Acudiente
 */
class Deportista extends CModelo{
 
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

    public function filtros() {
        return [
            'requeridos' => 'identificacion,nombre1,apellido1,telefono1,fecha_nacimiento,tipo_documento_id',
        ];
    }
    
    public function getEtiquetaEstado(){        
        if($this->estado_id == 1){
            return CHtml::e('span', 'Activo', ['class' => 'label label-success']);
        } else if($this->estado_id == 2){
            return CHtml::e('span', 'Inactivo', ['class' => 'label label-danger']);
        } else {
            return CHtml::e('span', $this->EstadoDeportista->nombre, ['class' => 'label label-default']);
        }
    }

    public function getNombreDePila(){
        return $this->getDatos();
    }
    
    public function getNombreIdentificacion(){
        return $this->getDatos();
    }    
    
    public function getDatos() {
        return $this->identificacion . " (" . $this->nombre1 . " " . $this->apellido1 . ")";
    }
    
    public function getNombreIdentificacion(){
        return $this->getDatos();
    }
    
    public function getAcudientes() {
        $da = $this->Acudiente;
        $acudientes = [];
        foreach ($da as $detalle) {
            $acudientes[] = $detalle->Acudiente;
        }
        return $acudientes;
    }
    
    public function getDocumentos() {
        $dc = $this->Documento;
        $documentos = [];
        foreach ($dc as $detalle) {
            $documentos[] = $detalle->Documento;
        }
        return $documentos;
    }
    
    /**
     * Esta función retorna las relaciones con otros modelos
     * @return array
     */
    protected function relaciones() {        
        return [
            # el formato es simple: 
            # tipo de relación | modelo con que se relaciona | campo clave foranea
            'EstadoDeportista' => [self::PERTENECE_A, 'EstadoDeportista', 'estado_id'],
            'TipoIdentificacion' => [self::PERTENECE_A, 'TipoIdentificacion', 'tipo_documento_id'],
            'Documento' => [self::CONTENGAN_A, 'DeportistaDocumento', 'deportista_id'],
            'Acudiente' => [self::CONTENGAN_A, 'DeportistaAcudiente', 'deportista_id'],
        ];
    }
    
    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
            'id_deportista' => 'Deportista',
            'identificacion' => 'Identificación',
            'nombre1' => 'Nombre 1',
            'nombre2' => 'Nombre 2',
            'apellido1' => 'Apellido 1',
            'apellido2' => 'Apellido 2',
            'direccion' => 'Dirección',
            'foto' => 'Foto',
            'telefono1' => 'Teléfono 1',
            'telefono2' => 'Teléfono 2',
            'fecha_nacimiento' => 'Fecha Nacimiento',
            'estado_id' => 'Estado',
            'tipo_documento_id' => 'Tipo Documento',
        ];
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
