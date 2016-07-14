<?php
/**
 * @package sistema.web.coms.bootstrap3
 * @author Jorge Alejandro Quiroz Serna <alejo.jko@gmai.com>
 * @version 1.0.0
 * @copyright (c) 2016, jakop
 */
abstract class CBBaseNavBar extends CComplemento{
    /**
     * El brand es el título que tendrá la barra de navegación 
     * @var string 
     */
    protected $brand;
    /**
     * El cuerpo es donde se continen las opciones del menú
     * @var string 
     */
    protected $cuerpo;
    /**
     * Contiene el html generado por las opciones de menú
     * @var string 
     */
    protected $form;
    /**
     * Contiene todo el html del menú al ser ensamblado
     * @var string 
     */
    protected $menu;
    
    /**
     * Contiene el html del input que será incluido en el formulario 
     * @var string
     */
    protected $_formInput = "";
    /**
     * Contiene las opciones que serán añadidas al formulario del menú
     * @var array 
     */
    protected $_opcionesFormulario = [];
    
    /**
     * Id del elemento nav
     * @var string 
     */
    public $_id = "bs-navbar";
    /**
     * Bandera que indica si la barra de navegación contendrá o no un formulario
     * @var boolean 
     */
    public $_form = false;
    /**
     * Array con los elementos que tendrá el menú, cada uno de los elementos (opciones del menú)
     * deberá contener como mínimo una posición text y una posición Url
     * array(
     *      'text' => 'opción', 'url' => ['controlador/accion']
     * );
     * Para indicar submenú
     * array(
     *      'text' => 'opción', 'url' => '#', 'elementos' => [['text' => '', 'url' => '#']]
     * );
     * @var array 
     */
    public $_elementos = [];
    /**
     * Titulo de la nav bar (marca)
     * @var string 
     */
    public $_brand = '';
    /**
     * Url a la que enviará la brand, puede ser string o array
     * @var mixed
     */
    public $_brandUrl = '#';
    /**
     * Opciones html del brand
     * @var array 
     */
    public $_opcionesBrand = [];
    /**
     * Tipo de barra de menú
     * @var string 
     */
    public $_tipo = 'dark';
    
    public function construirMenu(){
        $this->importarCss();
        $this->registrarScripts();
        $this->construirBrand();
        $this->construirCuerpo();
        $this->construirForm();
        $this->ensamblarMenu();
    }
   
    /**
     * Esta función permite construir el cuerpo de la barra de menú
     */
    public abstract function construirCuerpo();
    /**
     * Esta función permite construir la brand
     */
    public abstract function construirBrand();
    /**
     * Esta función permite construir el formulario del menú
     */
    public abstract function construirForm();
    /**
     * Esta función permite construir las opciones contenidas en el menú
     */
    public abstract function construirOpciones($elementos = [], $subElemento = false);    
    /**
     * Esta función permite ensamblar el menú
     */
    public abstract function ensamblarMenu();    
    /**
     * Esta función se puede usar para importar los archivos css o estilos necesarios para el funcionamiento del complemento
     */
    public function importarCss(){}
    /**
     * Esta función se puede usar para importar los archivos js o scripts necesarios para el funcionamiento del complemento
     */
    public function importarJs(){}
}
