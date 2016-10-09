<?php

class CBOpcionesPanel extends CComplemento{
    public $_tipoPanel = 'default';
    public $_OpcionesPanel = [];
    public $_tituloPanel = "Opciones";
    public $_posicionTitulo = "center";
    public $_opciones = [];
    public $_elementos = [];
    
    private $opciones;
            
    public function inicializar() {
        if(key_exists('elementos', $this->_opciones)){
            $this->_elementos = $this->_opciones['elementos'];
        }
        if(key_exists('opcionesPanel', $this->_opciones)){
            $this->_OpcionesPanel = $this->_opciones['opcionesPanel'];
        }
        unset($this->_opciones['elementos'], $this->_opciones['opcionesPanel']);
        $this->construirOpciones();
        $this->ensamblarOpciones();
    }
    
    private function ensamblarOpciones(){
        $titulo = CHtml::e('div', $this->_tituloPanel, ['class' => 'panel-heading text-' . $this->_posicionTitulo]);
        $opcPanel = $this->_OpcionesPanel;
        if(isset($opcPanel['class'])){
            $opcPanel['class'] = 'panel panel-' . $this->_tipoPanel . $opcPanel['class'];
        } else {
            $opcPanel['class'] = 'panel panel-' . $this->_tipoPanel;
        }
        $this->html = CHtml::e('div', $titulo.$this->opciones, $opcPanel);
    }
    
    private function construirOpciones(){
        $html = [];
        foreach($this->_elementos AS $op=>$url){
            $html[] = CHtml::link($op, $url, ['class'=>'list-group-item']);
        }
        $this->opciones = CHtml::e('div', implode('', $html), ['class' => 'list-group']);
    }

    public function iniciar() {
        echo $this->html;
    }

}
