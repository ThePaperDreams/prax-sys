<?php

class ComUsuario extends CComponenteUsuario {

    public $_usr;
    public $_clv;

    public function autenticar() {
        $usuario = Usuario::modelo()->primer([
            'where' => "t.nombre_usuario = '" . $this->usuario . "' and t.clave = '" . sha1($this->clave) . "'",
        ]);
        if ($usuario != null) {
            $this->error = false;
            $this->ID = $usuario->id_usuarios;
        } else {
            $this->error = true;
        }
        return !$this->error;
    }

}
