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
 class Pago extends CModelo{
 
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
            'id_pago' => ['pk'] ,
                'fecha',
                'valor_cancelado',
                'url_comprobante',
                'estado' => ['def' => '1'] ,
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
            	'fkTblPagosTblMatriculas1' => [self::PERTENECE_A, 'FkTblPagosTblMatriculas1', 'matricula_id'],
        ];
    }
    
    /**
     * Esta función retorna un alias dado a cada uno de los atributos del modelo
     * @return string
     */
    public function etiquetasAtributos() {
        return [
		'id_pago' => 'Id Pago', 
		'fecha' => 'Fecha', 
		'valor_cancelado' => 'Valor Cancelado', 
		'url_comprobante' => 'Url Comprobante', 
		'estado' => 'Estado', 
		'descuento' => 'Descuento', 
		'razon_descuento' => 'Razon Descuento', 
		'matricula_id' => 'Matricula Id', 
        ];
    }
    
    /**
     * Esta función permite listar todos los registros
     * @param array $criterio
     * @return Pago
     */
    public function listar($criterio = array()) {
        return parent::listar($criterio);
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
