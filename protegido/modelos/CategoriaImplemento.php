<?php

/**
 * Este modelo es la representación de la tabla tbl_categorias_implementos
 *
 * Atributos del modelo
 * @property int $id_categoria
 * @property string $nombre
 * @property string $descripcion
 * 
 * Relaciones del modelo
 */
class CategoriaImplemento extends CModelo {

    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "categorias_implementos";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_categorias_implementos
     * @return array
     */
    public function atributos() {
        return [
            'id_categoria' => ['pk'],
            'nombre',
            'descripcion',
            'estado' => ['def' => 1]
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
        ];
    }

    public function filtros() {
        return [
            'requeridos' => 'nombre',
            'seguros'=>'*',
        ];
    }
    
    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
            'id_categoria' => 'Id Categoria',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'estado' => 'Estado',
        ];
    }

    public function getEtiquetaEstado(){
        if($this->estado == 1){
            return CHtml::e('span', 'Activo', ['class' => 'label label-success']);
        }else {
            return CHtml::e('span', 'Inactivo', ['class' => 'label label-default']);
        }
    }
    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return CategoriaImplemento
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }

    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return CategoriaImplemento
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }

    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return CategoriaImplemento
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    }

    /**
     * Esta función retorna una instancia del modelo tbl_categorias_implementos
     * @param string $clase
     * @return CategoriaImplemento
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }

}
