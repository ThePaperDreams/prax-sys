<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CBaseGrid
 *
 * @author JAKO
 */
abstract class CBaseGrid extends CComplemento{
    protected $_filtros = null;
    protected $_modelo;
    protected $_paginacion = 10;
    protected $_columnas;    
    protected $_opciones = null;
    protected $_crud = false;
    protected $_criterios = [];
    
    protected $modelos = null;
    /**
     * Este atributo es una instancia de CModelo para obtener los labels del modelo
     * @var CModelo 
     */
    protected $tColumnas = [];
    protected $cModelo = null;
    protected $mEtiquetas = [];
    protected $cabecera = null;
    protected $filtros = null;
    protected $cuerpo = null;
    protected $pie = null;
    protected $pagina = 0;
    protected $totalPaginas = 0;
    protected $total = 0;
    protected $filtrosPost = [];
    
    protected $ths = [];
    
    protected $tokkens = [
        'pk' => 1,
    ];
    
    protected function crearModelo(){
        if(is_string($this->_modelo)){
            $this->filtrar();
            $this->_criterios['offset'] = $this->pagina * $this->_paginacion;
            $this->_criterios['limit'] = $this->_paginacion;
            $this->modelos = call_user_func([$this->_modelo, 'modelo'])->listar($this->_criterios);                        
            unset($this->_criterios['offset'], $this->_criterios['limit']);
            $this->total = call_user_func([$this->_modelo, 'modelo'])->contar($this->_criterios);
            $this->totalPaginas = ceil(intval($this->total) / intval($this->_paginacion));
            $this->cModelo = new $this->_modelo();
            $this->mEtiquetas = $this->cModelo->etiquetasAtributos();
        } else if($this->_modelo instanceof CModelo){
            # lógica si se pasa un módelo
        }
    }
    
    protected function filtrar(){
        $p = filter_input_array(INPUT_POST);
        if(!isset($p['filtro-tabla'])){ return false; }
        $campos = [];
        foreach($p['filtro-tabla'] AS $k=>$v){
            if($v == ''){
                continue;
            }
            $campos[] = "`$k` LIKE '%$v%'";
        }
        
        if(count($campos) == 0){ return false; }
        
        $this->filtrosPost = $p['filtro-tabla'];
        $this->_criterios['where'] = implode(' AND ', $campos);
    }
    
    public function inicializar() {
        $this->validarPaginas();
        $this->crearModelo();
        $this->construirColumnas();
        $this->construirFiltros();
        $this->crearCabecera();
        $this->crearCuerpo();
        $this->crearPie();
        $this->html = $this->ensamblar();
    }
    
    protected function validarPaginas(){
        $g = filter_input_array(INPUT_GET);
        if(isset($g['p'])){
            $this->pagina = intval($g['p']) - 1;
        } else {
            $this->pagina = 0;
        }
    }
    
    protected function construirColumnas(){
        if(is_string($this->_columnas)){
            $this->_columnas = str_replace(' ', '', $this->_columnas);
            $this->tColumnas = explode(',', $this->_columnas);
        } else if(is_array($this->_columnas)){
            $this->tColumnas = $this->_columnas;
        }
    }
    
    /**
     * 
     * @param CModelo $modelo
     */
    protected function construirColsFila(&$cols, $modelo){
        foreach($this->tColumnas AS $k=>$v){
            $opciones = [];
            if(is_string($k) && is_array($v)){
                $valor = isset($v['valor'])? $modelo->$v['valor'] : '';
                $opciones = isset($v['opciones'])? $v['opciones'] : [];
            } else if(is_string($k)){
                $valor = $this->evaluarExpFila($modelo, $v);
            } else {
                $valor = $modelo->$v;
            }
            $cols[] = CHtml::e("td", $valor, $opciones);
        }
    }
    
    protected function evaluarExpFila($modelo, $exp){
        if(is_callable($exp)){
            return $exp($modelo);
        } else if(is_string($exp)){            
            return eval('return $modelo->' . $exp . ';');
        }
    }
    
    /**
     * 
     * @param CModelo $modelo
     */
    protected function construirOpciones(&$columnas, $modelo = null){
        if($this->_opciones == true && !is_array($this->_opciones)){
            $controlador = Sis::apl()->controlador->ID;
            $this->_opciones = [
                ['i' => 'eye', 'title' => 'Ver', 'url' => $controlador . '/ver&{id:pk}'],
                ['i' => 'pencil', 'title' => 'Editar', 'url' => $controlador . '/editar&{id:pk}'],
                ['i' => 'trash', 'title' => 'Eliminar', 'url' => $controlador . '/eliminar&{id:pk}', 'opciones' => ['class' => 'op-eliminar']],
            ];
            $this->scriptConfirmar();
        }
        
        if($this->_opciones === null){  return false; }                
        
        $opciones = [];
        foreach ($this->_opciones AS $v){
            $opsHtml = isset($v['opciones'])? $v['opciones'] : [];
            if(isset($v['title'])){ $opsHtml['title'] = $v['title']; }
            if(isset($v['visible']) && !$this->evaluarExpVisible($v['visible'], $modelo)){ continue; }
            
            if(key_exists('i', $v)){
                $opciones[] = CHtml::link(CBoot::fa($v['i']), $this->evaluarExpresion($v['url'], $modelo), $opsHtml);
            } else if(key_exists('t', $v)){
                $opciones[] = CHtml::link($v['t'], $this->evaluarExpresion($v['url'], $modelo), $opsHtml);
            } else {
                $opciones[] = CHtml::link('', $this->evaluarExpresion($v['url'], $modelo), $opsHtml);
            }
        }
        $columnas[] = CHtml::e("td", implode(' ', $opciones), ['class' => 'text-center table-options']);
    }
    
    private function evaluarExpVisible($exp, &$m){
        return eval("return $exp;");
    }
    
    private function scriptConfirmar(){
        $script = '$(".op-eliminar").click(function(){'
                . 'return confirm("¿Seguro que desea realizar esta acción?");'
                . '});';
        Sis::Recursos()->Script($script, CMRecursos::POS_READY);
    }
    
    protected function evaluarExpresion($exp, $modelo){
        $partes = explode("&", $exp);
        if(count($partes) == 0){ return ''; }
        $ruta = $partes[0];
        if(count($partes) == 1){ return [$ruta]; }
        $p = $partes[1];
        $matches = [];
        preg_match_all('/\{.*?\}/', $p, $matches);
        $parametros = $this->construirParametros($matches[0], $modelo);
        return array_merge([$ruta], $parametros);
    }
    
    protected function construirParametros($parametros, $modelo){
        $r = [];
        foreach($parametros AS $p){
            $p = preg_replace('/(\{|\})/', '', $p);
            $partes = explode(':', $p);
            $r[$partes[0]] = $this->tokken($partes[1], $modelo);
        }
        return $r;
    }
    
    /**
     * 
     * @param type $t
     * @param CModelo $modelo
     * @return boolean
     */
    protected function tokken($t, $modelo){       
        
        if(key_exists($t, $this->tokkens)){
            switch ($this->tokkens[$t]){
                case 1: return $modelo->{$modelo->getPk()}; 
                default: null;
            }
        }else if(!key_exists($t, $this->tokkens) && property_exists($modelo, $t)){ 
            return $modelo->$t;
        } else {
            return $t;
        }
    }
    
    protected function getFiltros($filtros){
        $f = [];
        if(is_string($filtros)){
            $f = explode(',', str_replace(' ', '', $filtros));
        }
        return $f;
    }    
    
    abstract function ensamblar();

    abstract function crearCabecera();   
    
    abstract function crearCuerpo();
    
    abstract function crearPie();
    
    abstract function construirFiltros();
    
}