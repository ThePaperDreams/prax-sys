<?php

class Permisos extends CDisparador{
    public function ejecutar() {
        $ruta = $this->controlador->ID . '/' . $this->controlador->getAccion();        
        if(Sis::apl()->usuario->esVisitante && $ruta != 'principal/entrar' && $ruta != 'principal/recuperarClave' && $ruta != 'principal/restablecerClave') {
           $this->controlador->redireccionar('principal/entrar');
        }
    }

    public function inicializar() {
        
    }

}
