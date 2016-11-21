<?php
/**
 * Este modelo es la representación de la tabla tbl_lista_espera
 *
 * Atributos del modelo
 * @property int $id_lista
 * @property int $deportista_id
 * @property int $categoria_id
 * @property datetime $fecha_registro
 * @property int $estado
 * 
 * Relaciones del modelo
 * @property FkListasCategorias $fkListasCategorias
 * @property FkListaDeportista $fkListaDeportista
 */
 class ListaEspera extends CModelo{
 
    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "lista_espera";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_lista_espera
     * @return array
     */
    public function atributos() {
        return [
            'id_lista' => ['pk'] ,
                'deportista_id',
                'categoria_id',
                'fecha_registro',
                'estado' => ['def' => '1'] ,
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
            'Categoria' => [self::PERTENECE_A, 'Categoria', 'categoria_id'],
           'Deportista' => [self::PERTENECE_A, 'Deportista', 'deportista_id'],
        ];
    }
    
    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
        'edad' => 'Edad del deportista',
		'id_lista' => 'Id Lista', 
		'deportista_id' => 'Deportista Id', 
		'categoria_id' => 'Categoria Id', 
		'fecha_registro' => 'Fecha Registro', 
		'estado' => 'Estado', 
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
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return ListaEspera
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }
    
    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return ListaEspera
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }
    
    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return ListaEspera
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    } 

    /**
     * Esta función retorna una instancia del modelo tbl_lista_espera
     * @param string $clase
     * @return ListaEspera
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }
}