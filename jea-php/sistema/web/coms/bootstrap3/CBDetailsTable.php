<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CBDetailsTable
 *
 * @author JAKO
 */
class CBDetailsTable extends CComplemento{
    const AD = 0;
    const TEXTO = 1;
    const LISTA = 2;
    
    public $_campos = [];            
    
    private $tipoPanel = 'default';
    
    private $panel;
    private $pHeading;
    private $pBody;
    private $tabla;
    private $campos;
    private $columnas = 0;
    
    public function inicializar() {
        $this->construirCampos();
        $this->construirPanel();
        $this->ensamblarDetalles();
    }

    public function iniciar() {
        echo $this->html;
    }
    
    private function construirTabla(){
        $thead = [];
        $tbody = [];
                
                
    }
    
    private function encabezadosTabla(){
        $ths = [];
    }
    
    private function construirCampos(){
        $campos = [];
        foreach($this->_campos AS $k=>$v){
            $campos[] = $this->traerCampo($v);
        }
        $this->campos = implode('', $campos);
    }
    
    private function traerCampo($opciones){
        $campo = "";
        switch ($opciones['tipo']){
            case self::AD: 
                $campo = CBoot::boton($opciones['texto'], 'default', ['id' => $opciones['id']]);
                break;
            case self::TEXTO: 
                break;
            case self::LISTA:
                $campo = CBoot::select('', $opciones['elementos'], ['id' => $opciones['id'], 'group' => true, 'defecto' => 'Seleccione una opción']);
                $this->columnas ++;
                break;
            default: 
                return null;                
        }
        if(isset($opciones['columna'])){
            $campo = CHtml::e('div', $campo, ['class' => "col-sm-" . $opciones['columna']]);
        }
        return $campo;
    }
    
    private function ensamblarDetalles(){
        $this->html = $this->panel;
    }
    
    private function construirPanel(){
        $contenido = $this->campos;
        $contenido .= CHtml::e('hr');
        $this->pHeading = CHtml::e('div', '', ['class' => "panel-heading"]);
        $this->pBody = CHtml::e('div', $contenido, ['class' => 'panel-body']);
        $this->panel = CHtml::e('div', $this->pHeading . $this->pBody, ['class' => "panel panel-$this->tipoPanel"]);
    }

}
