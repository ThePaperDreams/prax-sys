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
 * @property string $nombreCompleto
 * 
 * Relaciones del modelo
 * @property EstadoDeportista $EstadoDeportista
 * @property TipoIdentificacion $TipoIdentificacion
 * @property Documento[] $Documento
 * @property Acudiente[] $Acudiente
 * @property FichaTecnica $Ficha
 */
class Deportista extends CModelo{
    
    private $matriculado = null;

    # propiedades de la grid
    public $doc;
    public $_nombreCompleto;
    public $_edad;
    public $categoria_id;
    public $matricula;


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
            'estado_anterior'
        ];
    }

    public function filtros() {
        return [
            'requeridos' => 'identificacion,nombre1,apellido1,telefono1,fecha_nacimiento,tipo_documento_id',
            'seguros' => '*'
        ];
    }
    
    public function getEtiquetaEstado(){        
        if($this->estado_id == 1){
            return CHtml::e('span', 'Activo', ['class' => 'label label-success']);
        } else if($this->estado_id == 2){
            return CHtml::e('span', 'Inactivo', ['class' => 'label label-danger']);
        } else {
            return CHtml::e('span', $this->EstadoDeportista->nombre, ['class' => 'label label-warning']);
        }
    }
    public function getNombreCompleto(){
        return "$this->nombre1 $this->nombre2 $this->apellido1 $this->apellido2";
    }
    public function getNombreDePila(){
        return $this->getDatos();
    }
    
    public function getNombreIdentificacion(){
        return $this->getDatos();
    }    
    
    public function getDatos() {
        return $this->identificacion . " - " . $this->nombre1 . " " . $this->apellido1;
    }
    /**
     * Esta función permite retornar los acudientes de un deportista
     * @return Acudiente
     */
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
    
    public function getEdad(){
        $fechaActual = new DateTime(); # creamos la fecha actual
        $fechaNacimiento = new DateTime($this->fecha_nacimiento);
        $diferencia = $fechaNacimiento->diff($fechaActual);
        return $diferencia->y;
    }
    
    public function getImagenPerfil(){
        if($this->foto !== "" && $this->foto !== null){
            //$icono = CBoot::fa('cloud-download');
            //$icono = CBoot::fa('file-photo-o');
            //$url = Sis::UrlBase() . 'publico/imagenes/deportistas/fotos/' . $this->foto;
            //return CHtml::link('Descargar ' . $icono, $url, ['class' => 'label label-primary', 'target' => '_blank', 'download' => $this->foto]);
            return CHtml::link('Ver Foto', '', ['class' => 'label label-primary', 'data-toggle' => 'modal', 'data-target' => '#photo', 'id' => 'a-modal']);            
        } else {
            return CHtml::e("span", 'Ninguna', ['class' => 'label label-info']);
        }
    }
    
    public function filtrosAjx() {       
        $c = new CCriterio();
        $concat = "CONCAT_WS(' ', t.nombre1,t.nombre2,t.apellido1,t.apellido2)";
        $c->unionIzq("tbl_matriculas", "m")
            ->donde("t.id_deportista", "=", "m.deportista_id AND m.estado = 1")
            ->condicion($concat, $this->_nombreCompleto, "LIKE")
            ->y("t.identificacion", $this->identificacion, "LIKE")
            ->y("fn_get_edad_deportistas(t.id_deportista)", $this->_edad, 'LIKE')
            ->y("fecha_nacimiento", $this->fecha_nacimiento, "LIKE")
            ->y("t.estado_id", $this->estado_id, "LIKE")
            ->orden("t.estado_id = 1", false)
            ->orden("t.id_deportista", false);
            // var_dump($_POST);
            // exit();

        if($this->matricula == 1){
            $c->noEsVacio("m.id_matricula");
        } else if($this->matricula == 2){
            $c->esVacio("m.id_matricula");
        }

        return $c;
    }
    
    public function getNombreCategoria(){         
//        $criterios = ["where" => "deportista_id = " . $this->id_deportista];            
        $c = new CCriterio();
        $c->condicion("deportista_id", $this->id_deportista)
            ->y("estado", "1");
        $matricula = Matricula::modelo()->primer($c);
        if (count($matricula) > 0) {
            return $matricula->Categoria->nombre;          
        }else{
            return "Sin categoría";
        }
    }
    
    public function getNoMatriculados(){
        $matriculas = Matricula::modelo()->listar(['select' => 't.deportista_id, t.deportista_id AS id_matricula', 'group' => 'deportista_id', 'where' => 'estado = 1']);
        $matriculados = CHtml::modeloLista($matriculas, "id_matricula", "deportista_id");
        $criterio = new CCriterio();
        if(count($matriculados) > 0){ $criterio->noEn("id_deportista", $matriculados); }
        $deportistas = Deportista::modelo()->listar($criterio);
        return $deportistas;
    }

    public function getMatriculado(){
        if($this->matriculado === null){
            $c = new CCriterio();
            $c->condicion("deportista_id", $this->id_deportista)
                ->y("estado", 1);
            $m = Matricula::modelo()->contar($c);
            $this->matriculado = $m != null;
        }

        if($this->matriculado){
            return CHtml::e("span", 'Si', ['class' => 'label label-success']);
        } else {
            return CHtml::e("span", 'No', ['class' => 'label label-default']);
        }

        return null;
    }
    
    public function estaMatriculado(){
        if($this->matriculado === null){
            $c = new CCriterio();
            $c->condicion("deportista_id", $this->id_deportista)
                ->y("estado", 1);
            $m = Matricula::modelo()->contar($c);
            $this->matriculado = $m != null;
        }        
        return $this->matriculado;
    }

    /**
     * 
     * @return FichaTecnica
     */
    public function getFicha(){
        $ficha = FichaTecnica::modelo()->primer([
            'where' => "deportista_id=$this->id_deportista",
        ]);
        if($ficha == null){ 
            $ficha = new FichaTecnica();
            $ficha->deportista_id = $this->id_deportista;
            $ficha->amonestacion = 0;
            $ficha->dorsal = 0;
            $ficha->expulsion = 0;
            $ficha->peso = 0;
            $ficha->talla = 0;
            $ficha->valorizacion = 0;
            $ficha->rh = 'N/A';
        }
        
        return $ficha;
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
            'Acudiente' => [self::CONTENGAN_A, 'DeportistaAcudiente', 'deportista_id']            
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
            'nombre1' => 'Primer Nombre',
            'nombre2' => 'Segundo Nombre',
            'apellido1' => 'Primer Apellido',
            'apellido2' => 'Segundo Apellido',
            'direccion' => 'Dirección',
            'foto' => 'Foto',
            'telefono1' => 'Teléfono 1',
            'telefono2' => 'Teléfono 2',
            'fecha_nacimiento' => 'Fecha Nacimiento',
            'estado_id' => 'Estado',
            'tipo_documento_id' => 'Tipo Documento',
            'categoria_id' => 'Categoría',
            'edad' => 'Edad',
            '_nombreCompleto' => 'Nombre',
            'doc' => 'Doc.',
            'matricula' => 'Matriculado',
            '_edad' => 'Edad',
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
