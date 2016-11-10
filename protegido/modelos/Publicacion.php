<?php

/**
 * Este modelo es la representación de la tabla tbl_publicaciones
 *
 * Atributos del modelo
 * @property int $id_publicacion
 * @property string $titulo
 * @property string $contenido
 * @property int $consecutivo
 * @property datetime $fecha_publicacion
 * @property datetime $fecha_disponibilidad
 * @property int $tipo_id
 * @property string $lugar
 * @property time $hora
 * @property int $estado_id
 * @property int $usuario_id
 * @property int $resumen
 * 
 * Relaciones del modelo
 * @property Usuario $Autor
 * @property TipoPublicacion $TipoPublicacion
 * @property EstadoPublicacion $EstadoPublicacion
 */
class Publicacion extends CModelo {
    private $comentarios = null;
    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "publicaciones";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_publicaciones
     * @return array
     */
    public function atributos() {
        return [
            'id_publicacion' => ['pk'],
            'titulo',
            'contenido',
            'consecutivo',
            'fecha_publicacion',
            'fecha_disponibilidad',
            'tipo_id',
            'estado_id',
            'usuario_id',
            'resumen',
            'img_previsualizacion',
            'vistas',
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
            'Autor' => [self::PERTENECE_A, 'Usuario', 'usuario_id'],
            'TipoPublicacion' => [self::PERTENECE_A, 'TipoPublicacion', 'tipo_id'],
            'EstadoPublic' => [self::PERTENECE_A, 'EstadoPublicacion', 'estado_id'],
        ];
    }

    public function getComentariosSinAprobar(){
        $c = new CCriterio();
        $c->condicion("estado", "2")
            ->y("publicacion_id", $this->id_publicacion);
        $total = Comentario::modelo()->contar($c);
        return $total > 0? CHtml::e('span', $total, ['class' => 'label label-danger']) : $total;
    }

    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
            'id_publicacion' => 'Id Publicación',
            'titulo' => 'Título',
            'contenido' => 'Contenido',
            'consecutivo' => 'Consecutivo',
            'fecha_publicacion' => 'Fecha de Publicación',
            'fecha_disponibilidad' => 'Disponible hasta',
            'tipo_id' => 'Tipo de Publicación',
            'estado_id' => 'Estado',
            'usuario_id' => 'Usuario Id',
            'resumen' => 'Resumen',
            'img_previsualizacion' => 'Imagen de previsualización',
            'comentarios' => 'Comentarios',
            'vistas' => 'Vistas',
        ];
    }

    public function getComentarios(){
        if($this->comentarios ===  null){
            $c = new CCriterio();
            $c->condicion("t.publicacion_id", $this->id_publicacion)
                ->orden("t.estado = 2", false)
                ->orden("fecha", true);
            $this->comentarios = Comentario::modelo()->listar($c);
        }

        return $this->comentarios;
    }

    public function getEtiquetaEstado() {
        if ($this->estado == 1) {
            return CHtml::e('span', 'Borrador', ['class' => 'label label-success']);
        } else if ($this->estado == 2) {
            return CHtml::e('span', 'Disponible', ['class' => 'label label-danger']);
        } else if ($this->estado == 3) {
            return CHtml::e('span', 'No Disponible', ['class' => 'label label-danger']);
        } else {
            return CHtml::e('span', 'Expirada', ['class' => 'label label-default']);
        }
    }

    public function getUltimo() {
        $sql = "SELECT MAX(consecutivo)ultimo FROM tbl_publicaciones ";
        $resultados = Sis::apl()->bd->ejecutarComando($sql);
        $max = $resultados[0]['ultimo'];
        return (int) $max + 1;
    }

    public function filtros() {
        return [
            'requeridos' => 'titulo,contenido,fecha_disponibilidad,tipo_id,estado_id',
            'seguros' => 'titulo,fecha_publicacion,fecha_disponibilidad',
        ];
    }
    
    public function antesDeGuardar() {
        if($this->tipo_id == 2){
            $this->validarCircular();
        }
        if($this->nuevo){
            $this->fecha_publicacion = date("Y-m-d H:i:s");
        }
        $this->contenido = str_replace('../', Sis::UrlBase(), $this->contenido);
    }
    
    private function validarCircular(){
        $c = new CCriterio();
        $c->condicion("tipo_id", "2");
        $c->orden("id_publicacion", false);
        $ultima = Publicacion::modelo()->primer($c);
        $this->consecutivo = intval($ultima->consecutivo) + 1;
    }

    public function filtrosAjx() {
        $criterio = new CCriterio();
        $criterio->condicion("titulo", $this->titulo, "LIKE")
                ->y("tipo_id", $this->tipo_id, "=")
                ->y("estado_id", $this->estado_id, "=")
                ->y("consecutivo", $this->consecutivo, "=");
        $criterio->orden('id_publicacion', false);

        return $criterio;
    }

    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return Publicacion
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }

    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return Publicacion
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }

    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return Publicacion
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    }

    /**
     * Esta función retorna una instancia del modelo tbl_publicaciones
     * @param string $clase
     * @return Publicacion
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }

}
