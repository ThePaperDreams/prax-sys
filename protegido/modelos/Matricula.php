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
            'fecha_realizacion'
        ];
    }
    
    public function filtros() {
        return [
            'requeridos' => 'deportista_id,fecha_pago,categoria_id',
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
        ];
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
    
    public function getComprobante(){
        if($this->url_comprobante !== "" && $this->url_comprobante !== null){
            $icono = CBoot::fa('cloud-download');
            $url = Sis::UrlBase() . 'publico/documentos/comprobantes/matriculas/' . $this->url_comprobante;
            return CHtml::link('Descargar ' . $icono, $url, ['target' => '_blank', 'download' => $this->url_comprobante]);
        } else {
            return CHtml::e("span", 'Ninguno', ['class' => 'label label-default']);
        }
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

}
