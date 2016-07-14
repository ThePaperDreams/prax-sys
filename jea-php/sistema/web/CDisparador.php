<?php
/*
 * Esta clase es la base para cualquier disparador
 * @package sistema.web
 * @author Jorge Alejandro Quiroz Serna (jako) <alejo.jko@gmail.com>
 * @version 1.0.7
 * @copyright (c) 2015, jakop
 * 
 */
abstract class CDisparador {
    /**
     * Todo disparador podrá acceder al controlador actual de la aplicación
     * @var CControlador 
     */
    protected $controlador;
    
    public function __construct(CControlador $controlador) {
        $this->controlador = $controlador;
    }
    
    public abstract function inicializar();
    
    public abstract function ejecutar();
}
