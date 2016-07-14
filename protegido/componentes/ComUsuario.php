<?php

class ComUsuario extends CComponenteUsuario{
    public $_usr;
    public $_clv;
                
    public function autenticar() {
        $usuario = Usuario::modelo()->primer([
            'where' => "t.nombre_usuario = '" . $this->usuario . "'",
        ]);
        if ($usuario != null && $usuario->clave === sha1($this->clave)) {
            $this->error = false;
            $this->ID = $usuario->id_usuario;
        } else {
            $this->error = true;
        }
        return !$this->error;
    }
}