<?php

/**
 * Este modelo es la representación de la tabla tbl_pagos
 *
 * Atributos del modelo
 * @property int $id_pago
 * @property string $fecha
 * @property double $valor_cancelado
 * @property string $url_comprobante
 * @property tinyint $estado
 * @property double $descuento
 * @property double $razon_descuento
 * @property int $matricula_id
 * 
 * Relaciones del modelo
 * @property FkTblPagosTblMatriculas1 $fkTblPagosTblMatriculas1
 */
class Pago extends CModelo {

    /**
     * Esta función retorna el nombre de la tabla representada por el modelo
     * @return string
     */
    public function tabla() {
        return "pagos";
    }

    /**
     * Esta función retorna los atributos de la tabla tbl_pagos
     * @return array
     */
    public function atributos() {
        return [
            'id_pago' => ['pk'],
            'fecha',
            'valor_cancelado',
            'url_comprobante',
            'estado' => ['def' => '1'],
            'descuento',
            'razon_descuento',
            'matricula_id',
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
            'MatriculaPago' => [self::PERTENECE_A, 'Matricula', 'matricula_id'],
        ];
    }

    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
            'id_pago' => 'Pago',
            'fecha' => 'Fecha',
            'valor_cancelado' => 'Valor Cancelado',
            'url_comprobante' => 'Comprobante',
            'estado' => 'Estado',
            'descuento' => 'Descuento',
            'razon_descuento' => 'Razon Descuento',
            'matricula_id' => 'Deportista',
            'valorFormateado' => 'Valor Cancelado',
        ];
    }

    public function filtros() {
        return[
            'requeridos' => 'valor_cancelado,url_comprobante'
        ];
    }

     public function filtrosAjx() {
        $criterio = new CCriterio();
        $concat = "CONCAT_WS(' ', d.nombre1,d.apellido1)";
           $criterio->union("tbl_matriculas", "m")
                ->donde("m.id_matricula", "=", "t.matricula_id")
                ->union("tbl_deportistas", "d")
                ->donde("d.id_deportista", "=", "m.deportista_id")
                ->condicion($concat, $this->matricula_id, "LIKE")
                ->y("t.estado", $this->estado, "=")
                ->y("t.descuento", $this->descuento, "=")
                ->y("t.fecha", $this->fecha, "LIKE")
                ->y("t.valor_cancelado", $this->valor_cancelado, "=");
        return $criterio;
    }
    
    public function getEtiquetaEstado() {
        if ($this->estado == 1) {
            return CHtml::e('span', 'Activo', ['class' => 'label label-success']);
        } else if ($this->estado == 0) {
            return CHtml::e('span', 'Anulado', ['class' => 'label label-danger']);
        }
    }

    public function getUrlDescarga() {
        if ($this->url_comprobante !== "") {
            $span = CHtml::e("span", 'Descargar', ['class' => 'label label-primary']);
            $url = Sis::UrlBase() . 'publico/documentos/pagos/' . $this->url_comprobante;
            return CHtml::link($span, $url, ['target' => '_blank', 'download' => $this->url_comprobante]);
        } else {
            return CHtml::e("span", 'Sin comprobante', ['class' => 'label label-default']);
        }
    }

    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return Pago
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
    }

    public function getValorFormateado() {
        return "$ " . number_format($this->valor_cancelado);
    }

    /**
     * Esta función permite obtener un registro por su primary key
     * @param int $pk
     * @return Pago
     */
    public function porPk($pk) {
        return parent::porPk($pk);
    }

    /**
     * Esta función permite obtener el primer registro
     * @param array $criterio
     * @return Pago
     */
    public function primer($criterio = array()) {
        return parent::primer($criterio);
    }

    /**
     * Esta función retorna una instancia del modelo tbl_pagos
     * @param string $clase
     * @return Pago
     */
    public static function modelo($clase = __CLASS__) {
        return parent::modelo($clase);
    }

}
