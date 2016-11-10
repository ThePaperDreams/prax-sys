<?php
/**
 * Este modelo es la representación de la tabla tbl_acudientes
 *
 * Atributos del modelo
 * @property int $id_acudiente
 * @property string $identificacion
 * @property string $nombre1
 * @property string $nombre2
 * @property string $apellido1
 * @property string $apellido2
 * @property string $direccion
 * @property string $email
 * @property string $telefono1
 * @property string $telefono2
 * @property int $estado
 * @property int $tipo_doc_id
 * 
 * Relaciones del modelo
 * @property TipoIdentificacion $TipoIdentificacion
 * @property Documentos[] $Detalles
 */
class Acudiente extends CModelo{
    public $_nombreCompleto;
    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "acudientes";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_acudientes
     * @return array
     */
    public function atributos() {
        return [
            'id_acudiente' => ['pk'],
            'identificacion',
            'nombre1',
            'nombre2',
            'apellido1',
            'apellido2',
            'direccion',
            'email',
            'telefono1',
            'telefono2',
            'estado' => ['def' => '1'],
            'tipo_doc_id',
        ];
    }

    public function filtros() {
        return [
            'requeridos' => 'identificacion,nombre1,apellido1,tipo_doc_id',
            'seguros' => '*',
        ];
    }
    
    public function getEtiquetaEstado(){
        if($this->estado == 1){
            return CHtml::e('span', 'Activo', ['class' => 'label label-success']);
        } else if($this->estado == 0){
            return CHtml::e('span', 'Inactivo', ['class' => 'label label-danger']);
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
            'TipoIdentificacion' => [self::PERTENECE_A, 'TipoIdentificacion', 'tipo_doc_id'],
            'Detalles' => [self::CONTENGAN_A, 'AcudienteDocumento', 'acudiente_id'],
        ];
    }
    
    public function getDocumentos() {
        $dc = $this->Detalles;
        $documentos = [];
        foreach ($dc as $detalle) {
            $documentos[] = $detalle->Documento;
        }
        return $documentos;
    }
    
    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
            'id_acudiente' => 'Acudiente',
            'identificacion' => 'Identificación',
            'nombre1' => 'Primer Nombre',
            'nombre2' => 'Segundo Nombre',
            'apellido1' => 'Primer Apellido',
            'apellido2' => 'Segundo Apellido',
            'direccion' => 'Dirección',
            'email' => 'Email',
            'telefono1' => 'Teléfono 1',
            'telefono2' => 'Teléfono 2',
            'estado' => 'Estado',
            'tipo_doc_id' => 'Tipo Documento',
            '_nombreCompleto' => 'Nombre',
        ];
    }
    
    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return Acudiente
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }
    
    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return Acudiente
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }
    
    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return Acudiente
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    } 

    /**
     * Esta función retorna una instancia del modelo tbl_acudientes
     * @param string $clase
     * @return Acudiente
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }

    public function getDatos() {
        return $this->identificacion . " (" . $this->nombre1 . " " . $this->apellido1 . ")";
    }
    
    public function getNombreCompleto(){
        return "$this->nombre1 $this->nombre2 $this->apellido1 $this->apellido2";
    }
    
    public function filtrosAjx() {
        $criterio = new CCriterio();
        $concat = "CONCAT_WS(' ', t.nombre1,t.nombre2,t.apellido1,t.apellido2)";
           $criterio->condicion($concat, $this->_nombreCompleto, "LIKE")
                ->y("t.estado", $this->estado, "=")
                ->y("t.telefono1", $this->telefono1, "LIKE")
                ->y("t.identificacion", $this->identificacion, "LIKE")
                ->orden("t.estado", false)
                ->orden("t.id_acudiente", false);
        return $criterio;
    }
    
    public function getAcudiente($id, $nombre) {        
        $icono = CBoot::fa("eye");
        $url = Sis::UrlBase() . $id . '/Acudiente/ver';
        return CHtml::link($icono . ' ' . $nombre , $url, ['target' => '_blank']);
    }
    
    public function antesDeGuardar() {
        if($this->estado == null){ $this->estado = 0; }
    }
}