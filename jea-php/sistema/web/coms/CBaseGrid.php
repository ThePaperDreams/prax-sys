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
    protected $_id = "cb-grid";
    protected $_filtros = null;
    protected $_filtrosAjax = null;
    protected $filtradoAjax = false;
    protected $_ajax = false;
    protected $_orden = false;
    protected $_exportar = [];
    /**
     * @var CModelo
     */
    protected $_modelo;
    protected $_paginacion = 10;
    protected $_columnas;    
    protected $_opciones = null;
    protected $_crud = false;
    /**
     * Función que selrá llamada para obtener los criterios del modelo
     * @var string
     */
    protected $_fnCriterios = 'filtrosAjx';
    /**
     *
     * @var CCriterio 
     */
    protected $_criterios = [];
    
    protected $modelos = null;
    /**
     * Este atributo es una instancia de CModelo para obtener los labels del modelo
     * @var CModelo 
     */
    protected $tColumnas = [];
    /**
     * Instancia temporal del modelo
     * @var CModelo 
     */
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
            if(is_array($this->_criterios)){
                $this->_criterios['offset'] = $this->pagina * $this->_paginacion;
                $this->_criterios['limit'] = $this->_paginacion;
                $this->modelos = call_user_func([$this->_modelo, 'modelo'])->listar($this->_criterios);
                unset($this->_criterios['offset'], $this->_criterios['limit']);
            } else {
                $this->_criterios->limitar($this->_paginacion, $this->pagina * $this->_paginacion);                
                $this->modelos = call_user_func([$this->_modelo, 'modelo'])->listar($this->_criterios);
                $this->_criterios->limpiar("limite", "apartirDe");
            }
            $this->total = call_user_func([$this->_modelo, 'modelo'])->contar($this->_criterios);
            $this->totalPaginas = ceil(intval($this->total) / intval($this->_paginacion));
            $this->mEtiquetas = $this->cModelo->etiquetasAtributos();
        } else if(is_array($this->_modelo) && count($this->_modelo) > 0){
            $clase = get_class($this->_modelo[0]);
            $this->cModelo = new $clase;
            $this->modelos = $this->_modelo;
            $this->mEtiquetas = $this->cModelo->etiquetasAtributos();
            $this->total = count($this->cModelo);
            $this->totalPaginas = ceil(intval($this->total) / intval($this->_paginacion));
        }
    }
    
    protected function instanciarModelo(){
        $this->cModelo = new $this->_modelo();
    }
    
    protected function setAtributosModelo(&$modelo, $atributos){
        foreach($atributos AS $k=>$v){
            $modelo->$k = $v;
        }
    }
    
    protected function filtrosAjax(){
        # construimos los filtros via ajax
        $p = filter_input_array(INPUT_POST);
        if(!isset($p['filtro-tabla-ajx'])){ return false; }        
        unset($p['filtro-tabla-ajx']);
        foreach($p AS $k=>$v){ if($v === ''){ unset($p[$k]); } }
        $this->filtradoAjax = true;
        $this->instanciarModelo();
        $this->cModelo->limpiarAtributos();

        foreach($p AS $k=>$v){ $this->cModelo->$k = $v; }

        $criterio = $this->cModelo->{$this->_fnCriterios}();
        
        if($criterio === null){
            foreach($this->_filtrosAjax AS $k=>$v){
                if(!isset($p[$v]) || $p[$v] == ''){ continue; }
                $campos[] = "`$v` LIKE '%" . $p[$v] . "%'";
            }
            if(isset($campos) && count($campos) > 0){
                $this->_criterios['where'] = implode(' AND ', $campos);      
            }            
        } else {
            $this->_criterios = $criterio;
        }
        
        if(isset($p['orden']) && $p['orden'] != 'false'){
            $orden = $p['orden'] == 'ASC';
            $this->_criterios->orden("t." . $p['campoOrden'], $orden);
        }
        
        $this->crearModelo();   
        $this->validarPaginas();
        $this->construirColumnas();
        $this->crearCuerpoAjx();
        $this->crearPie();
        $body = $this->cuerpo;
        $pie = $this->pie;
        header("Content-Type: Application/json");
        echo json_encode([
            'body' => $body,
            'pie' => $pie,
        ]);
        Sis::fin();
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
        $this->filtrosAjax();
        $this->instanciarModelo();
        $this->crearModelo();
        $this->construirColumnas();
        $this->construirFiltros();
        $this->crearCabecera();
        if($this->_ajax === true){
            $this->crearCuerpoAjx();
            $this->crearPie($this->_ajax);
            $this->html = $this->ensamblar();
            $this->scriptsAjax();
        } else {
            $this->crearCuerpo();
            $this->crearPie();
            $this->html = $this->ensamblar();
            $this->scriptConfirmar();            
        }
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
        }
        
        if($this->_opciones === null || !$this->_opciones){  return false; }
        
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
        // $script = '$(".op-eliminar").click(function(){'
        //         . 'return confirm("¿Seguro que desea realizar esta acción?");'
        //         . '});';
        $script = '$(".op-eliminar").click(function(){
            alert("about to delete");
            return false;
        })';                
        Sis::Recursos()->Script($script, CMRecursos::POS_READY);
    }
    
    private function scriptsAjax(){
        $campos = $this->camposScript();
        $script = 'var p = undefined;' .
                  '$(function(){' .  
                    '$("input.j-grid-filtro").keyup(function(e){' .  
                        'if(e.which === 13){' .  
                            '$("#" + $(this).attr("id") + "-tokken").val($(this).val());' . 
                            'ejefiltroTabla();' .  
                        '}' .  
                    '});' .
                    
                    '$("select.j-grid-filtro").change(function(){' . 
                        '$("#" + $(this).attr("id") + "-tokken").val($(this).val());' . 
                        'ejefiltroTabla();' . 
                    '});' .

                    '$("input.campo-fecha.j-grid-filtro").change(function(){' . 
                        '$("#" + $(this).attr("id") + "-tokken").val($(this).val());' . 
                        'ejefiltroTabla();' . 
                    '});' .
                
                    '$(".btn-orden").click(function(){' . 
                        '$(".btn-orden").attr("data-active", "false");' . 
                        'if($(this).hasClass("fa-caret-down")){' . 
                            '$(this).removeClass("fa-caret-down")' . 
                                    '.addClass("fa-caret-up")' . 
                                    '.attr("data-active", "true")' . 
                                    '.attr("data-type", "DESC");' . 
                        '} else {' . 
                            '$(this).removeClass("fa-caret-up")' . 
                                    '.addClass("fa-caret-down")' . 
                                    '.attr("data-active", "true")' . 
                                    '.attr("data-type", "ASC");' . 
                        '}' . 
                        'ejefiltroTabla(p);' . 
                    '});' . 
                
                    'setLinkEvents();' .  
                    '$(".btn-exportar-grid").click(function(){' .
                        'var form = $("#form-exportar-grid");' .
                        'var url = $(this).attr("data-action");' .
                        'form.attr("action", url);' .
                        'form.submit();' .
                    '});' .
                '});';

        $scriptConfirmar = '$(".op-eliminar").click(function(){' . 
                            'var link = $(this);' . 
                            'Lobibox.confirm({' .
                                'title : "Confirmación",' .
                                'msg : "¿Está seguro desea ejecutar esta acción?",' . 
                                'buttons: { ' . 
                                    'yes: {text : "Si", class : "btn btn-success"},' .
                                    'no: {text : "No", class: "btn btn-default"}, ' . 
                                '},' . 
                                'callback    : function($this, type, evt){' . 
                                    'if(type == "yes"){' . 
                                        'window.location = link.attr("href");' .
                                    '}' . 
                                '}' . 
                            '});' . 
                            'return false;' .
                        '});';


        $script .= 'function setLinkEvents(){' . 
                        '$(".j-grid-link-pag").click(function(){ ' . 
                            'p = $(this).attr("data-p");' .
                            'ejefiltroTabla($(this).attr("data-p"));' . 
                            'return false;' . 
                        '});' . 
                        $scriptConfirmar . 
                        // '$(".op-eliminar").click(function(){' . 
                        //     'return confirm("¿Seguro que desea realizar esta acción?");' . 
                        // '});' . 
                    '}';
        $script .= 'function ejefiltroTabla(p){' . 
                        'var orden = $(".btn-orden[data-active=\'true\']").attr("data-type");' . 
                        'var nombre = $(".btn-orden[data-active=\'true\']").attr("data-name");' .
                        'var url = "' . Sis::apl()->urlActual() . '" + (p !== undefined? "?p=" + p : "");' . 
                        '$.ajax({' . 
                            '"type": "POST",' . 
                            '"url" : url,' . 
                            '"data" : {' . 
                                '"filtro-tabla-ajx" : true,' . 
                                'orden: orden !== undefined? orden : false,' . 
                                'campoOrden: nombre,' .
                                $campos . 
                            '},' . 
                            'success: function(obj){' . 
                                '$("#' . $this->_id . ' tbody").html(obj.body);' . 
                                '$("#' . $this->_id . '-pagination").html(obj.pie);' . 
                                'setLinkEvents();' . 
                            '}' . 
                        '});' . 
                    '}';
        Sis::Recursos()->Script($script, CMRecursos::POS_BODY);
    }
    
    private function camposScript(){
        $filtros = [];
        foreach($this->_filtrosAjax AS $k=>$v){
            if(is_string($k)){
                $filtros[] = $k;
            } else {
                $filtros[] = $v;
            }
        }
        $campos = implode(', ', array_map(function($k){
            return "$k : $(\"#filtro-tabla-$k\").val()";
        }, $filtros));
        return $campos;
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
        }else if(!key_exists($t, $this->tokkens) && $modelo->$t !== null){ 
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
    
    abstract function crearCuerpoAjx();
    
    abstract function crearPieAjx();
    
}
