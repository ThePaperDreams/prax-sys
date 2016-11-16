<?php

class ComUsuario extends CComponenteUsuario{
    public $_usr;
    public $_clv;
    public $nombres;
                
    public function autenticar() {
        $c = new CCriterio();
        $c->condicion('t.nombre_usuario', $this->usuario)
            ->o('t.email', $this->usuario)
            ->y('rol_id', 6, '<>');
            
        $usuario = Usuario::modelo()->primer($c);

        if ($usuario != null && $usuario->clave === sha1($this->clave) && $usuario->estado == '1') {
            if($usuario->recuperacion == '1'){
                $this->error = true;
            } else {          
                $this->error = false;
                $this->ID = $usuario->id_usuario;            
                $this->nombres = $usuario->NombreMasUsuario;                
            }
        } else {
            $this->error = true;
        }
        return !$this->error;
    }
    
    public function getFoto($url = false){
        $usuario = Usuario::modelo()->porPk(Sis::apl()->usuario->ID);
        if($url){
            return $usuario->fotoUrl;
        } else{            
            return $usuario->fotoAsignada;
        }
    }
}
