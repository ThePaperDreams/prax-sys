<?php

class CtrlPrincipal extends CControlador {

    public function inicializar() {
        parent::inicializar();
    }

    public function accionEjemplo() {
        $this->plantilla = "basica";
        $this->vista('ejemploFormularios');
    }

    public function accionInicio() {
        $this->mostrarVista('inicio');
    }

    public function accionAcerca() {
        $this->mostrarVista("acerca");
    }

    public function accionContacto() {
        $this->mostrarVista("contacto");
    }

    public function accionEntrar() {
        if (!Sis::apl()->usuario->esVisitante) {
            $this->redireccionar('inicio');
        }

        if (isset($this->_p['login-usr']) && isset($this->_p['login-pwd'])) {
            $comUsuario = new ComUsuario($this->_p['login-usr'], $this->_p['login-pwd']);
            $comUsuario->cargarConfiguracion();
            if ($comUsuario->autenticar()) {
                Sis::apl()->usuario->iniciarSesion($comUsuario->ID, $comUsuario->usuario);
                $this->redireccionar('inicio');
            }
        }

        $this->mostrarVista("entrar");
    }

    public function accionSalir() {
        if (!Sis::apl()->usuario->esVisitante) {
            Sis::apl()->usuario->cerrarSesion();
            $this->redireccionar("entrar");
        }
        $this->redireccionar("inicio");
    }

}
