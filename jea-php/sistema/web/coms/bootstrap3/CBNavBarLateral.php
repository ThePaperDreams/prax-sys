<?php

/**
 * Este complemento permite crear una barra de navegación lateral.
 * Hay dos tipos: 
 * - dark
 * - flat-1
 * @package sistema.web.coms.bootstrap3
 * @author Jorge Alejandro Quiroz Serna (Jako) <alejo.jko@gmail.com>
 * @version 1.0.0
 * @copyright (c) 2016, jakop
 * 
 */

Sis::importar('!siscoms.bootstrap3.CBBaseNavBar');

class CBNavBarLateral extends CBBaseNavBar{
    /**
     * Al construir las opciones de menú de un Dropdown si el hijo (submenú)
     * está seleccionado, quiere decir que debemos seleccinar el padre
     * @var boolean 
     */
    private $padreActivo = false;
    /**
     * Tema seleccionado para el menú
     * @var string 
     */
    public $_tipo = "dark";
    
    public function inicializar() {
        $this->construirMenu();
    }

    public function iniciar() {
        echo $this->html;
    }
    
    public function construirMenu() {
        parent::construirMenu();
    }
    
    public function construirBrand() {
        if($this->_brand != ""){            
            $link = CHtml::link($this->_brand, $this->_brandUrl, $this->_opcionesBrand);
            $this->brand = CHtml::e("div", $link, ['class' => 'nav-bar-header']);
        }
    }

    public function construirCuerpo() {
        $this->cuerpo = $this->construirOpciones($this->_elementos);        
    }

    public function construirForm() {
        if($this->_form){
            $inputDefecto = CBoot::text("", ['placeholder' => 'Buscar...']) . CBoot::fa("search");
            $this->_formInput =  $this->_formInput == ""? $inputDefecto
                     : $this->_formInput;
            $this->_opcionesFormulario['class'] = (isset($this->_opcionesFormulario['class'])?
                    $this->_opcionesFormulario['class'] . ' ' : '') . 'nav-bar-form';            
            $this->form = CHtml::e("form", $this->_formInput, $this->_opcionesFormulario);
        }
    }

    /**
     * Esta función permite crear las opciones que conforman el menú
     * @param array $elementos
     * @param boolean $subElemento Si estamos construyendo opciones de primer nivel segundo
     *                              El complemento solo permite generar menús de dos niveles
     * @return array
     */
    public function construirOpciones($elementos = array(), $subElemento = false) {
        $opcs = []; # los elementos del menú en html
        foreach($elementos AS $elemento){
            $texto = isset($elemento['texto'])? $elemento['texto'] : '';
            $url = isset($elemento['url'])? $elemento['url'] : '#';
            $activo = (is_array($url) && isset($url[0]) && $url[0] == Sis::apl()->ruta)? 
                    'active' : '';
            
            if($activo != '' && $subElemento){ $this->padreActivo = true; }
            
            $opcionesLink = isset($elemento['opcionesLink'])? $elemento['opcionesLink'] : [];
            $opcionesEl = isset($elemento['opciones'])? $elemento['opciones'] : [];            
            # si hay llamado recursivo
            if(isset($elemento['elementos']) && !$subElemento){
                $subElementos = $this->construirOpciones($elemento['elementos'], true);
                $opcionesEl['class'] = isset($opcionesEl['class'])? 
                        $opcionesEl['class'] . " nav-drop-down $activo" : 
                        "nav-drop-down $activo";
                
                if($this->padreActivo){
                    $opcionesEl['class'] .= ' active';
                    $this->padreActivo = false;
                }
                
                $hipervinculo = CHtml::link($texto, '#', $opcionesLink);
                $opcs[] = CHtml::e("li", $hipervinculo . $subElementos, $opcionesEl);
            } else {
                $opcionesEl['class'] = isset($opcionesEl['class'])? $opcionesEl['class'] . " $activo" : $activo;
                $hipervinculo = CHtml::link($texto, $url, $opcionesLink);
                $opcs[] = CHtml::e("li", $hipervinculo, $opcionesEl);
            }
        }
        return CHtml::e("ul", implode('', $opcs));        
    }

    public function ensamblarMenu() {
        $menu = $this->brand . $this->form . $this->cuerpo;
        $this->html = CHtml::e("nav", $menu, ['class' => "nav-bar-tmp $this->_tipo"]);
    }
    
    public function importarCss() {
        Sis::Recursos()->registrarRecursoCSS([
            'ruta' => Sis::resolverRuta('!siscoms.bootstrap3.assets.css') . DS . 'CBNavBarLateral.css',
            'alias' => 'lateral-nav-bar',
            'pos' => CMRecursos::POS_HEAD
        ], true);
    }
    
    public function registrarScripts(){
        $script = 'jQuery(".nav-drop-down ul").css("display", "none");' . 
                'jQuery(".nav-drop-down").click(function(){' .
                       'if(!jQuery(this).hasClass("open")){' . 
                           'jQuery(".nav-drop-down.open ul").slideUp();' .
                           'jQuery(".nav-drop-down").removeClass("open");' .                
                           'jQuery(this).addClass("open");' .
                           'jQuery(this).find("ul").slideDown()'.
                       '} else {' .
                           'jQuery(this).find("ul").slideUp();' .
                           'jQuery(this).removeClass("open");' . 
                           'jQuery(this).find("ul").slideUp()'.
                       '}' . 
                   '});';
        Sis::Recursos()->registrarScriptCliente($script);
    }
}
