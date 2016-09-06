<?php

class Permisos extends CDisparador{
    public function ejecutar() {
        $ruta = $this->controlador->ID . '/' . $this->controlador->getAccion();
        $rutasValidas = $ruta == 'principal/entrar' || $ruta == 'principal/recuperar' ||
                $ruta == "principal/restablecer";
        if(Sis::apl()->usuario->esVisitante && $rutasValidas === false) {
           $this->controlador->redireccionar('principal/entrar');
        }
    }

    public function inicializar() {
        
    }

}
