<?php

/**
 * Este modelo es la representación de la tabla tbl_matriculas
 *
 * Atributos del modelo
 * @property int $id_matricula
 * @property string $fecha_pago
 * @property string $url_comprobante
 * @property tinyint $estado
 * @property int $deportista_id
 * @property int $categoria_id
 * @property string $anio
 * 
 * Relaciones del modelo
 * @property Deportista $Deportista
 * @property Categoria $Categoria
 */
class Matricula extends CModelo {

    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "matriculas";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_matriculas
     * @return array
     */
    public function atributos() {
        return [
            'id_matricula' => ['pk'],
            'fecha_pago',
            'url_comprobante',
            'estado' => ['def' => '1'],
            'deportista_id',
            'categoria_id',
            'anio',
            'fecha_realizacion',
            'club_id',
        ];
    }
    
    public function filtros() {
        return [
            'requeridos' => 'deportista_id,fecha_pago,categoria_id,club_id',
            'seguros' => '*',
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
            'Categoria' => [self::PERTENECE_A, 'Categoria', 'categoria_id'],
            'Club' => [self::PERTENECE_A, 'Club', 'club_id'],
        ];
    }

    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
            'id_matricula' => 'Id',
            'fecha_pago' => 'Fecha de pago',
            'url_comprobante' => 'Comprobante',
            'estado' => 'Estado',
            'deportista_id' => 'Deportista',
            'categoria_id' => 'Categoría',
            'anio' => 'Año de vigencia',
            'fecha_realizacion' => 'Realizado',
            'club_id' => 'Club',
        ];
    }
    
    public function filtrosAjx() {
        $criterio = new CCriterio();
        $concat = "CONCAT_WS(' ', t2.identificacion, t2.nombre1, t2.nombre2, t2.apellido1, t2.apellido2)";
        $criterio
            ->union("tbl_deportistas", "t2")
            ->donde("t2.id_deportista", "=", "t.deportista_id")
            ->condicion('estado', 1)
            ->y($concat, $this->deportista_id, "LIKE")
            ->y("t.estado", $this->estado, "=")
            ->y("t.fecha_pago", $this->anio, "LIKE")
            ->y("t.categoria_id", $this->categoria_id)
            ->orden("estado", false)
            ->orden("fecha_realizacion", false);
        return $criterio;
    }

    public function filtrosAnuladas(){
        $criterio = new CCriterio();
        $concat = "CONCAT_WS(' ', t2.identificacion, t2.nombre1, t2.nombre2, t2.apellido1, t2.apellido2)";
        $criterio->union("tbl_deportistas", "t2")
            ->donde("t2.id_deportista", "=", "t.deportista_id")
            ->condicion($concat, $this->deportista_id, "LIKE")
            ->y('t.estado', '1')
            ->y("t.estado", $this->estado, "=")
            ->y("t.fecha_pago", $this->anio, "LIKE")
            ->y("t.categoria_id", $this->categoria_id)
            ->orden("estado", false)
            ->orden("fecha_realizacion", false);
        return $criterio;
    }
    
    public function antesDeGuardar() {
        if($this->nuevo){
            $this->anio = date('Y');
            $this->fecha_realizacion = date('Y-m-d H:i:s');
        }
    }
    
    public function getEtiquetaEstado(){
        if($this->estado == 1){
            return CHtml::e('span', 'Vigente', ['class' => 'label label-success']);
        } else if($this->estado == 0){
            return CHtml::e('span', 'Anulado', ['class' => 'label label-danger']);
        } else {
            return CHtml::e('span', 'Expirada', ['class' => 'label label-default']);
        }
    }
    
    public function getFechaRF(){
        $p = explode(" ", $this->fecha_realizacion);
        return $p[0];
    }

    public function getComprobante(){
        if($this->url_comprobante !== "" && $this->url_comprobante !== null){
            $icono = CBoot::fa('cloud-download');
            $url = Sis::UrlBase() . 'publico/documentos/comprobantes/matriculas/' . $this->url_comprobante;
            return CHtml::link('Descargar ' . $icono, $url, ['target' => '_blank', 'download' => $this->url_comprobante]);
        } else {
            // return CHtml::e("span", 'Ninguno', ['class' => 'label label-default']);
            return false;
        }
    }   
    
    public static function getDeportistasSinMatricula($matricula = false){
        $matriculas = Matricula::modelo()->listar([
            'where' => "estado = 1",
        ]);
        $ids = [];
        foreach($matriculas AS $m){  $ids[] = $m->deportista_id; }
        # si se llama para registrar una matricula
        if($matricula){
            $deportistas = Deportista::modelo()->listar([
                'where' => "id_deportista NOT IN (" . implode(',', $ids) . ")",
            ]);
        } else {
            $deportistas = Deportista::modelo()->listar([
                'where' => "id_deportista NOT IN (" . implode(',', $ids) . ") AND estado_id <> 4",
            ]);
        }
        return $deportistas;
                
    }
    /**
     * 
     * @return Deportista[]
     */
    public static function getDeportistasMatriculados(){
        $matriculas = Matricula::modelo()->listar([
            'where' => "estado = 1",
        ]);
        $deportistas = [];        
        foreach($matriculas AS $m){  $deportistas[] = $m->Deportista; }
        return $deportistas;                
    } 

    public static function getDeporitstasMatriculadosClub($club = true){
        $criterio = new CCriterio();
        $criterio->condicion("estado", 1);

        if($club == true){ $criterio->y("club_id", 1); }
        else { $criterio->y("club_id", 1, '<>'); }
        $matriculas = Matricula::modelo()->listar($criterio);
        $deportistas = [];
        foreach($matriculas AS $m){  
            if($m->Deportista->estado_id == '1'){ $deportistas[] = $m->Deportista; }
        }
        return $deportistas;           
    }

    public static function getMatriculados(){
        return self::getDeportistasMatriculados();
    }
    
    

    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return Matricula
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }

    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return Matricula
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }

    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return Matricula
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    }

    /**
     * Esta función retorna una instancia del modelo tbl_matriculas
     * @param string $clase
     * @return Matricula
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }
    
    /**
     * 
     * @return Deportista[]
     */
    public static function listarDeportistas(){
        $matriculas = self::modelo()->listar([
            'where' => 'estado = 1',
        ]);
        
        $deportistas = [];
        foreach ($matriculas AS $m){
            $deportistas[$m->id_matricula] = $m->Deportista->nombreCompleto;
        }
        return $deportistas;
    }

}
