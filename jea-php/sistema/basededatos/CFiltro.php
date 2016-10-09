<?php
/**
 * Esta clase es la encargada de recoger los filtros especificados en el modelo y 
 * ejecutarlos
 * @package sistema.basesdedatos
 * @author Jorge Alejandro Quiroz Serna (Jako) <alejo.jko@gmail.com>
 * @version 1.0.0
 * @copyright (c) 2016, jakop 
 */
class CFiltro {
    /**
     * Representación del modelo al que se le aplican los filtros
     * @var CModelo 
     */
    private $m;
    private $atributos = [];
    private $logErrores = [];
    
    public function __construct(&$modelo) {
        $this->m = $modelo;
    }
    
    /**
     * Esta función aplica los filtros al modelo
     * @return boolean
     */
    public function ejecutarFiltros(){
        $reglas = $this->m->filtros();
        $this->atributos = $this->m->atributos();
        # validamos campos requeridos
        $this->validarRequeridos($reglas);
        $this->camposSeguros($reglas);
        $this->limpiarComillas();
        $this->m->setErrores($this->logErrores);
        return count($this->logErrores) > 0;
    }
    
    public function limpiarComillas(){        
        foreach($this->atributos AS $k=>$v){
            if(is_string($k)){
                $this->m->$k = str_replace("'", "\'", $this->m->$k);
                $this->m->$k = str_replace('"', '\"', $this->m->$k);
            } else {
                $this->m->$v = str_replace("'", "\'", $this->m->$v);
                $this->m->$v = str_replace('"', '\"', $this->m->$v);
            }
        }
    }
    
    /**
     * Esta función verifica la segurdad de todos los campos
     * @param array $r
     */
    private function camposSeguros($r = []){
        $this->limpios($r);
    }
    
    /**
     * Esta función se ocupa de ejcutar los filtros de campos requeridos
     * @param filtros $r
     * @return boolean
     */
    private function validarRequeridos($r = []){        
        if(!isset($r['requeridos']) || count($r['requeridos']) == 0){
            return false;
        }
        # removemos cualquier espacio de los campos requeridos
        $r['requeridos'] = str_replace(' ', '', str_replace(' ', '', $r['requeridos']));
        # separamos los campos requeridos para recorrerlos
        $campos = explode(',', $r['requeridos']);
        $errores = [];
        $etiquetas = $this->m->etiquetasAtributos();
        # recorremos los campos requeridos
        foreach ($campos AS $campo){
            # si un campo requerido está vacio en el modelo, lo agregamos a los errores
            if(trim($this->m->$campo) == ""){
                $errores[$campo] = $etiquetas[$campo];
            }
        }

        if(count($errores) > 0){
            # llenamos un log de errores que pueda ser obtenido despues
            $this->logErrores['requeridos'] = $errores;
        }               
        
        return count($errores) > 0;
    }
    
    /**
     * Esta función permite limpiar los campos de inyección de código js
     * @param arary $r
     * @return boolean
     */
    private function limpios($r){
        if(!isset($r['seguros'])){
            return false;
        }
        # validamos, si se usa el token especial * para filtrar todos los campos
        if(is_string($r['seguros']) && $r['seguros'] == '*'){
            $tmp = $this->m->atributos(); # esta variable alojará temporalmente los campos del modelo
            $campos = [];                 # aquií almacenaremos los nombres de los campos a filtrar
            foreach ($tmp AS $k=>$v){
                $campos[] = is_string($k)? $k : $v; # si el indice es string es por que el campo tiene opciones extra
            }
        } else {
            $campos = explode(',', $r['seguros']);
        }
        foreach($campos AS $c){
            $this->m->$c = strip_tags($this->m->$c);
        }
    }
    
}
