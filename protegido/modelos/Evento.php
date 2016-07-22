<?php
/**
 * Este modelo es la representación de la tabla tbl_eventos
 *
 * Atributos del modelo
 * @property int $id_evento
 * @property string $titulo
 * @property string $contenido
 * @property datetime $fecha_publicacion
 * @property datetime $fecha_disponibilidad
 * @property int $tipo_id
 * @property string $lugar
 * @property time $hora
 * @property int $estado
 * 
 * Relaciones del modelo
 */
 class Evento extends CModelo{
 
    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "eventos";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_eventos
     * @return array
     */
    public function atributos() {
        return [
		'id_evento' => ['pk'] , 
		'titulo', 
		'contenido', 
		'fecha_publicacion', 
		'fecha_disponibilidad', 
		'tipo_id', 
		'lugar', 
		'hora', 
		'estado', 
                'autor',
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
            'TipoEvento' => [self::PERTENECE_A, 'TipoEvento', 'tipo_id'],
            'Estado' => [self::PERTENECE_A, 'EstadoEvento', 'estado'],
            
        ];
    }
    
    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
		'id_evento' => 'Id Evento', 
		'titulo' => 'Título', 
		'contenido' => 'Contenido', 
		'fecha_publicacion' => 'Fecha de Publicación', 
		'fecha_disponibilidad' => 'Fecha de Disponibilidad', 
		'tipo_id' => 'Tipo de Evento', 
		'lugar' => 'Lugar', 
		'hora' => 'Hora', 
		'estado' => 'Estado', 
                'autor' => 'Autor', 
        ];
    }
    
    public function filtros() {
        return [
            'requeridos' => 'titulo,contenido,fecha_publicacion,fecha_disponibilidad,tipo_id,lugar,hora,estado_id','autor',
            'seguros' => 'titulo,fecha_publicacion,fecha_disponibilidad','lugar','hora','autor',
        ];
    }
    
    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return Evento
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }
    
    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return Evento
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }
    
    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return Evento
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    } 

    /**
     * Esta función retorna una instancia del modelo tbl_eventos
     * @param string $clase
     * @return Evento
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }
}
