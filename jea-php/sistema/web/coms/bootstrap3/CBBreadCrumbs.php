<?php

class CBBreadCrumbs extends CComplemento{
    public $_migas;
    public $_opcionesHtml = [];
    
    public function inicializar() {
        if(isset($this->_migas) && count($this->_migas) > 0){
            $this->construirOpciones();
            $this->ensamblarBreadCrumb();            
        }
    }

    public function iniciar() {
        echo $this->html;
    }
    
    private function ensamblarBreadCrumb(){
        $this->html = CHtml::e("div", $this->html, ['class' => 'col-sm-12']);
        $this->html = CHtml::e("div", $this->html, ['class' => 'row']);
    }
    
    private function construirOpciones(){
        $opciones = [];
        foreach($this->_migas AS $k=>$v){
            if(is_string($k)){
                $link = CHtml::link($k, $v);
                $opciones[] = CHtml::e("li", $link);
            } else {
                $opciones[] = CHtml::e("li", $v);
            }
        }
        
        $this->_opcionesHtml['class'] = 'breadcrumb ' . 
                (isset($this->_opcionesHtml['class'])? 
                $this->_opcionesHtml['class'] . 'hidden-xs' : 'hidden-xs');
        
        $this->html = CHtml::e('ul', implode('', $opciones), $this->_opcionesHtml);
    }

}
