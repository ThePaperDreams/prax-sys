<?php

class CSAdminSideNav extends CComplemento{
    /**
     * Id de la barra de menú
     * @var string 
     */
    public $_id = 'bs-example-navbar-collapse';
    /**
     * Elementos del memú principal
     * @var array 
     */
    public $_elementos = [];
    /**
     * Marca de la barra de menú
     * @var string 
     */
    public $_brand;
    /**
     * Ruta a la que enviaría la marca de menú principal
     * @var string 
     */
    public $_brandUrl;
    /**
     * Tipo de navbar de bootstrap
     * <ul>
     *  <li>inverse</li>
     *  <li>defaul</li>
     * </ul>
     * @var string 
     */
    public $_tipo = 'default';
    /**
     * si la navbar es fixed o no
     * <ul>
     *  <li>top</li>
     *  <li>bottom</li>
     * </ul>
     * @var string 
     */
    public $_fixed = '';
    /**
     * Formulario del menú
     * @var array 
     */
    public $_form = null;
    /**
     * Menú de la derecha del menú
     * @var array 
     */
    public $_menuDerecha = null;        
    
    private $ruta;
    
    private $padreEncontrado = false;
    private $activo = false;
    private $posicionActiva = -1;
    
    public function __construct() {
        $this->ruta = Sis::apl()->ruta;
    }
    
    
    public function inicializar() {
        $this->html = $this->construirMenu();
    }

    public function iniciar() {
        echo $this->html;
    }
    
    /**
     * Esta función construye todo el menú
     * @return string
     */
    private function construirMenu(){
        
//        $containerFluid = CHtml::e('div', $cabecera.$cuerpo, ['class' => 'container-fluid']);
//        $clase = "navbar navbar-$this->_tipo" . ($this->_fixed != ''? " navbar-fixed-$this->_fixed" : "");
//        return CHtml::e('div', $containerFluid, ['class' => $clase]);
        $opciones = $this->construirOpciones($this->_elementos);
        return $opciones;
    }
    
    /**
     * Esta función construye las opciones y sub opciones de cualquier menú (izquerda o derecha)
     * Solo funciona a dos niveles, mas niveles serán ignorados
     * @param array $elementos
     * @param array $opciones
     * @param boolean $subElementos bandera para indicar si se construirán subelementos
     * @return string
     */
    private function construirOpciones($elementos = [], $opciones = [], $subElementos = false){
        $items = [];
        foreach($elementos AS $elemento){
            $texto = isset($elemento['texto'])? $elemento['texto'] : '';                     
            $i = isset($elemento['i'])? $elemento['i'] : '';
            $fa = isset($elemento['fa'])? CBoot::fa($elemento['fa']) : '';
            $opLink = isset($elemento['opcionesLink'])? $elemento['opcionesLink'] : [];
            $opLink['class'] = $i;
            # Si hay elementos y no se trata de crear subelementos
            if(isset($elemento['elementos']) && !$subElementos){
                $texto = CHtml::e("span", $texto, ['class' => 'menu-item']);                
                $link = CHtml::link( $fa . $texto, '#', ['class' => $i]);   
                $subItems = $this->construirOpciones($elemento['elementos'], [$opciones], true);                
                # si esta variable cambia a true, significa que uno de los elementos hijo está seleccionado
                $opcionesLi = [
                    'class' => 'dropdown ',
                ];
                if($this->activo){
                    $opcionesLi['class'] .= ' active'; 
                    $this->activo = false;
                }
                $items[] = CHtml::e('li', $link.$subItems, $opcionesLi);
            } else {
                $opcionesLi = [];
                $esActivo = isset($elemento['url']) && 
                            is_array($elemento['url']) && 
                            $elemento['url'][0] == $this->ruta;
                # activamos la opción si fue seleccionada
                if(!$this->activo && $esActivo){ $opcionesLi['class'] = 'active'; }
                if($esActivo && $subElementos){ $this->activo = true; }
                
                $link = CHtml::link($fa . $texto, (isset($elemento['url'])? $elemento['url'] : '#'), $opLink);
                $items[] = CHtml::e('li', $link, $opcionesLi);
            }
        }
        if(!$subElementos){            
            $opciones['class'] = "list-unstyled side-menu";
            return CHtml::e('ul', implode('', $items), $opciones);
        } else {
            return CHtml::e('ul', implode('', $items), ['class' => 'list-unstyled menu-item']);
        }
    }      
}
