<?php

/**
 * Este modelo es la representación de la tabla tbl_tipos_publicacion
 *
 * Atributos del modelo
 * @property int $id_tipo_publicacion
 * @property string $nombre
 * @property string $descripcion
 * @property int $consecutivo
 * 
 * Relaciones del modelo
 */
class TipoPublicacion extends CModelo {
    private $_resumen = null;
    private $_yaAsociado = null;
    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "tipos_publicacion";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_tipos_publicacion
     * @return array
     */
    public function atributos() {
        return [
            'id_tipo_publicacion' => ['pk'],
            'nombre',
            'descripcion',
        ];
    }

    /**
     * Esta función retorna las relaciones con otros modelos
     * @return array
     */
    protected function relaciones() {
        return [
            'Publicaciones' => [self::CONTENGAN_A, 'Publicacion', 'tipo_id'],
                # el formato es simple: 
                # tipo de relación | modelo con que se relaciona | campo clave foranea
        ];
    }

    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
            'id_tipo_publicacion' => 'Id Tipo Publicacion',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripción',
            'consecutivo' => 'Consecutivo',
        ];
    }

    public function filtros() {
        return [
            'requeridos' => 'nombre',
            'seguros' => '*',
        ];
    }

    public function getResumen(){
        if($this->_resumen == null){
            $this->_resumen = strlen($this->descripcion) > 50? 
                substr($this->descripcion, 0, 50) . '...' : $this->descripcion;
        }
        return $this->_resumen;
    }

    public function filtrosAjx() {
        $criterio = new CCriterio();
        $criterio->condicion("nombre", $this->nombre, "LIKE");
        return $criterio;
    }

    public function getYaAsociado(){
        if($this->_yaAsociado == null){
            $c = new CCriterio();
            $c->condicion("t.tipo_id", $this->id_tipo_publicacion);
            $publicaciones = Publicacion::modelo()->contar($c);
            $this->_yaAsociado = $publicaciones > 0;
        }
        
        return $this->_yaAsociado;
    }

    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return TipoPublicacion
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }

    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return TipoPublicacion
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }

    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return TipoPublicacion
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    }

    /**
     * Esta función retorna una instancia del modelo tbl_tipos_publicacion
     * @param string $clase
     * @return TipoPublicacion
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }

}
