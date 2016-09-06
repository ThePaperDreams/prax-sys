<?php
/**
 * Esta clase permite construir los criterios que tendrá una consulta
 * @package sistema.basededatos
 * @author Jorge Alejandro Quiroz Serna (Jako) <alejo.jko@gmail.com>
 * @version 1.0.0
 * @copyright (c) 2016, jakop
 */
class CCriterio {
    private $columnas = null;
    private $union = null;
    private $condicion = null;
    private $orden = null;    
    private $agrupar = null;
    private $limite = null;
    private $apartirDe = null;
    
    private $unionActual = null;
    
    public function __construct() {}
    
    /**
     * Esta función permite setear las columnas que serán seleccionadas 
     * en la consulta
     * @param string $columnas
     * @return CCriterio
     */
    public function columnas($columnas = '*'){
        $this->columnas = $columnas;
        return $this;
    }
    
    /**
     * Esta función permite agregar la condición inicial para la consulta
     * @param string $campo1
     * @param string $operador
     * @param string $campo2
     * @return CCriterio
     */
    public function condicion($campo1, $campo2, $operador = '='){
        if($campo2 === null){ return $this; }
        if($operador == 'LIKE'){ $campo2 = "'%$campo2%'"; }
        else if(is_string($campo2)){ $campo2 = "'$campo2'"; }
        $this->condicion = "$campo1 $operador $campo2";
        return $this;
    }
    
    /**
     * Esta función permite concatenar más condiciones a la consulta usando
     * el operador AND
     * @param string $campo1
     * @param string $operador
     * @param string $campo2
     * @return CCriterio
     */
    public function y($campo1, $campo2, $operador = '='){
        if($campo2 === null){ return $this; }
        if($this->condicion != "" && $this->condicion != null){ $this->condicion .= " AND "; }
        
        if($operador == 'LIKE'){ $campo2 = "'%$campo2%'"; }
        else if(is_string($campo2)){ $campo2 = "'$campo2'"; }
        
        $this->condicion .= "$campo1 $operador $campo2";
        return $this;
    }
    
    /**
     * Esta función permite concatenar más condiciones a la consulta usando el operador
     * OR
     * @param string $campo1
     * @param string $operador
     * @param string $campo2
     * @return CCriterio
     */
    public function o($campo1, $campo2, $operador){
        if($campo2 === null){ return $this; }
        if($this->condicion != "" && $this->condicion != null){ $this->condicion .= " OR "; }        
        if($operador == 'LIKE'){ $campo2 = "'%$campo2%'"; }
        else if(is_string($campo2)){ $campo2 = "'$campo2'"; }
        $this->condicion .= "$campo1 $operador $campo2";
        return $this;
    }
    
    public function en($campo, $lista = [], $y = true){
        if($this->condicion !== null && $this->condicion !== ""){
            $this->condicion .= ($y? " AND" : " OR");
        }
        $valores = implode(', ', $lista);
        $this->condicion .= " $campo IN(" . $valores . ")";
        return $this;
    }
    
    public function noEn($campo, $lista = [], $y = true){
        if($this->condicion !== null && $this->condicion !== ""){
            $this->condicion .= ($y? " AND" : " OR");
        }
        $valores = implode(', ', $lista);
        $this->condicion .= " $campo NOT IN(" . $valores . ")";
        return $this;
    }
    
    /**
     * Esta función permite indicar el orden que se dará a los registros
     * @param string $orden
     * @return CCriterio
     */
    public function orden($orden, $asc = true){
        if($this->orden !== "" && $this->orden !== null){
            $this->orden .= ", ";
        }
        $this->orden .= $orden . " " . ($asc? "ASC" : "DESC");
        return $this;
    }
    
    /**
     * Esta función permite establecer un JOIN sencillo
     * @param string $tabla tabla con la que se hará el join
     * @param string $alias alias para la tabla 
     * @return CCriterio
     */
    public function union($tabla, $alias){
        $this->unionActual = "JOIN $tabla AS $alias";
        return $this;
    }
    /**
     * Esta función permite establecer un JOIN por la IZQUIERDA
     * @param string $tabla tabla con la que se hará el join
     * @param string $alias alias para la tabla 
     * @return CCriterio
     */
    public function unionIzq($tabla, $alias){
        $this->unionActual = "LEFT JOIN $tabla AS $alias";
        return $this;        
    }
    /**
     * Esta función permite establecer un JOIN por la DERECHA
     * @param string $tabla tabla con la que se hará el join
     * @param string $alias alias para la tabla 
     * @return CCriterio
     */
    public function unionDer($tabla, $alias){
        $this->unionActual = "RIGHT JOIN $tabla AS $alias";
        return $this;
    }
    
    /**
     * Esta función permite establecer la condición bajo la cual se hará un JOIN
     * @param string $campo1
     * @param string $operador
     * @param string $campo2
     * @return CCriterio
     */
    public function donde($campo1, $operador, $campo2){
        $this->unionActual .= " ON $campo1 $operador $campo2";
        if($this->union !== null) {
            $this->union .= " ";
        }
        $this->union .= $this->unionActual . " ";
        $this->unionActual = null;        
        return $this;
    }
    /**
     * Esta función permite establecer el limite de los registros 
     * @param int $limite
     * @param int $apartirDe
     * @return CCriterio
     */
    public function limitar($limite = 10, $apartirDe = 0){
        $this->limite = $limite;
        $this->apartirDe = $apartirDe;
        return $this;
    }
    
    /**
     * Esta función permite establecer el agrupamiento de los registros
     * @return CCriterio
     */
    public function agrupar(){
        $columnas = func_get_args();
        if(count($columnas) > 0){
            $this->agrupar = implode(', ', $columnas);    
        }        
        return $this;
    }
    
    /**
     * Esta función permite obtener los criterios en un array
     * @return array
     */
    public function getCriterios(){
        $criterios = [];
        if($this->columnas !== null){ $criterios['select'] = $this->columnas; }
        if($this->union !== null){ $criterios['join'] = $this->union; }
        if($this->condicion !== null){ $criterios['where'] = $this->condicion; }
        if($this->agrupar !== null){ $criterios['group'] = $this->agrupar; }
        if($this->orden !== null){ $criterios['order'] = $this->orden; }
        if($this->limite !== null){ $criterios['limit'] = $this->limite; }
        if($this->apartirDe !== null){ $criterios['offset'] = $this->apartirDe; }
        return $criterios;
    }
    
    /**
     * Esta función sirve para limpiar los criterios seteados
     */
    public function limpiar(){
        $criterios = func_get_args();
        foreach($criterios aS $criterio){
            if(property_exists($this, $criterio)){
                $this->$criterio = null;
            }
        }
    }
}
