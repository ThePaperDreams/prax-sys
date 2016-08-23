<?php
/**
 * Esta clase permite generar una grid completa de bootstrap
 * @package sistema.web.coms.bootstrap3
 * @author Jorge Alejandro Quiroz Serna (Jako) <alejo.jko@gmail.com>
 * @version 1.0.0
 * @copyright (c) 2016, jakop
 */
Sis::importar("!siscoms.CBaseGrid");
class CBGrid extends CBaseGrid{
    private $camposScript = [];
            
    public function inicializar() {
        parent::inicializar();
    }

    public function iniciar() {
        echo $this->html;
    }

    public function crearCabecera() {
        $this->ths = $this->encabezados();
        $infoText = 'Total registros: ' . $this->total;
        $info = CHtml::e('th', $infoText, ['colspan' => count($this->ths)]);
        $tr = CHtml::e('tr', $info);
        $tr .= CHtml::e('tr', implode('', $this->ths));
        $this->cabecera = CHtml::e('thead', $tr . $this->filtros);
    }
    
    private function encabezados(){
        $ths = [];
        foreach($this->tColumnas AS $k=>$c){
            if(is_string($k)){
                $nombreColumna = $k;
            } else {                
                $nombreColumna = $c;
            }
            $orden = "";
            if($this->_orden === true){ $this->construirOrden($orden, $nombreColumna);}
            if(key_exists($nombreColumna, $this->mEtiquetas)){
                $ths[] = CHtml::e('th',  $orden . " " . $this->mEtiquetas[$nombreColumna], ['class' => 'text-center']);
            }
        }
        
        if($this->_opciones != null || is_array($this->_opciones)){
            $ths[] = CHtml::e('th', 'Opciones', ['class' => 'text-center']);
        }
        
        return $ths;
    }
    
    private function construirOrden(&$orden, $nombreColumna){
        $orden = CBoot::fa('caret-down', ['class' => 'btn-orden', 'style' => 'cursor:pointer;', 'data-type' => 'ASC', 'data-active' => 'false', 'data-name' => $nombreColumna]);
    }

    public function crearCuerpo() {
        if($this->total > 0){            
            $filas = $this->filas();
            $this->cuerpo = CHtml::e("tbody", implode('', $filas));
        } else {
            $columnas = count($this->tColumnas) + ($this->_opciones != null? 1 : 0);
            $td = CHtml::e("td", "No hay registros", ['class' => "text-center", 'colspan' => $columnas]);
            $tr = CHtml::e("tr", $td);
            $this->cuerpo = CHtml::e("tbody", $tr);
        }
    }
    
    public function filas(){
        $trs = [];
        foreach ($this->modelos AS $modelo){
            $tds = [];
            $this->construirColsFila($tds, $modelo);
            $this->construirOpciones($tds, $modelo);
            $trs[] = CHtml::e("tr", implode('', $tds));
        }
        return $trs;
    }

    public function crearPie() {
        if($this->total > 0 && $this->total > $this->_paginacion){
            $lis = $this->crearPaginacion();
            $ul = CHtml::e("ul", $lis, ['class' => 'pagination']);
            $cols = CHtml::e("div", $ul, ['class' => 'col-sm-8']);
            $row = CHtml::e("div", $cols, ['class' => 'row']);
            if($this->filtradoAjax == true){
                $pag = $row;
            } else {
                $pag = CHtml::e("div", $row, ['class' => 'table-pagination', 'id' => $this->_id . '-pagination']);                
            }
            $this->pie = $pag;  
        }
    }
    
    private function crearPaginacion(){
        $lis = [];
        $ctrl = Sis::Controlador()->ID;
        $accion = Sis::Controlador()->getAccion();
        
        if($this->pagina > 0){            
            $lis [] = CHtml::e('li', CHtml::link(CHtml::e('span', '&laquo;'), ["$ctrl/$accion", 'p' => 1], ['class' => 'j-grid-link-pag', 'data-p' => 1]));
        }
        
        for($i = 1; $i <= $this->totalPaginas; $i ++){
            $link = CHtml::link($i, ["$ctrl/$accion", 'p' => $i], ['class' => 'j-grid-link-pag', 'data-p' => $i]);
            if($i  == $this->pagina + 1){
                $lis[] = CHtml::e('li', $link, ['class' => 'active']);
            } else {
                $lis[] = CHtml::e('li', $link);
            }
        }
        if($this->pagina < $this->totalPaginas - 1){
            $lis [] = CHtml::e('li', CHtml::link(CHtml::e('span', '&raquo;'), ["$ctrl/$accion", 'p' => $this->totalPaginas], ['class' => 'j-grid-link-pag', 'data-p' => $this->totalPaginas]));
        }
        return implode('', $lis);
    }
    
    private function crearPaginacionAjx(){
        
    }

    public function ensamblar() {
        $contenido = $this->cabecera . $this->cuerpo;
        $t = CHtml::e("table", $contenido, ['class' => 'table table-bordered', 'id' => $this->_id]);
        if($this->filtros !== null && $this->_filtrosAjax === null){
            $input = CHtml::input('submit', 'buscar', ['style' => 'display:none']);
            $t = CHtml::e('form', $t . $input, ['method' => 'POST']);
        }
        return $t . $this->pie;
    }
    
    public function construirFiltros() {
        if($this->_filtros === null && $this->_filtrosAjax === null){ return false;}
        $ths = [];
        
        if($this->_filtrosAjax == null){
            $filtros = $this->getFiltros($this->_filtros);            
        } else {
            $filtros = $this->_filtrosAjax;
        }
        foreach($this->tColumnas AS $k=>$v){
            if(is_string($k)){
                $ths[] = $this->construirCampoFiltro($filtros, $k);
            } else {
                $ths[] = $this->construirCampoFiltro($filtros, $v);
            }
        }
        
        if($this->_opciones !== null){ $ths[] = CHtml::e('th', '&nbsp', []); }
        
        $tr = CHtml::e('tr', implode('', $ths));
        $this->filtros = $tr;
    }
    
    protected function construirCampoFiltro($filtros, $atributo){
        if(in_array($atributo, $filtros)){
            $val = isset($this->filtrosPost[$atributo])? $this->filtrosPost[$atributo] : '';
            $campo = CBoot::text($val, ['name' => "filtro-tabla[$atributo]", 'id' => "filtro-tabla-$atributo", 'class' => 'j-grid-filtro']);
            $this->camposScript[] = $atributo;
            return CHtml::e('th', $campo, []);
        } else {
            return CHtml::e('th', '&nbsp', []);
        }
    }

    public function crearCuerpoAjx() {
        if($this->total > 0){            
            $filas = $this->filas();
            $this->cuerpo = implode('', $filas);
        } else {
            $columnas = count($this->tColumnas) + ($this->_opciones != null? 1 : 0);
            $td = CHtml::e("td", "No hay registros", ['class' => "text-center", 'colspan' => $columnas]);
            $tr = CHtml::e("tr", $td);
            $this->cuerpo =  $tr;
        }
    }

    public function crearPieAjx() {}

}
