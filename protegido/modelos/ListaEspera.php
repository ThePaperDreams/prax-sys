<?php 

class ListaEspera extends CModelo{
    public $_nombreCompleto;
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
            return CHtml::link('Ver Foto', '', ['class' => 'label label-primary', 'data-toggle' => 'modal', 'data-target' => '#photo', 'id' => 'a-modal']);            
        } else {
            return CHtml::e("span", 'Ninguna', ['class' => 'label label-info']);
        }
    }
    
    public function filtrosAjx() {       
        $c = new CCriterio();
        $concat = "CONCAT_WS(' ', t.nombre1,t.nombre2,t.apellido1,t.apellido2)";
        $c->condicion($concat, $this->_nombreCompleto, "LIKE")
            ->y("t.identificacion", $this->identificacion, "LIKE")
            ->y("t.estado_id", "4", "LIKE")
            ->orden("t.id_deportista", false);
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
        $criterio->noEn("id_deportista", $matriculados);
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