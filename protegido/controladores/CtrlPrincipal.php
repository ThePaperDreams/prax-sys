<?php

class CtrlPrincipal extends CControlador{
    
    public function inicializar() {
        parent::inicializar();
        $this->plantilla = 'login';
    }   
    
    public function accionRestablecer(){
        
    }
    
    public function accionRecuperar(){
        $email = "";
        # si se envia el correo
        if(isset($this->_p['email']) && $this->_p['email'] != ""){
            $email = $this->_p['email'];
            $criterio = new CCriterio();
            $criterio->condicion("email", $this->_p['email']);
            $usuario = Usuario::modelo()->primer($criterio); 
            if($usuario == null){
                $tipo = 'error';
                $msg = 'No se encuentra un usuario registrado con ese email';
            } else {
                $mensaje = $this->vistaP("_emailRecuperar");
                $this->enviarEmail($email, $mensaje);
                $tipo = 'success';
                $msg = 'Se ha enviado un email a su cuenta de correo';
            }
            Sis::Sesion()->flash("alerta", [
                'tipo' => $tipo,
                'msg' => $msg,
            ]);
            $this->redireccionar("recuperar");
        } else if(isset($this->_p['email']) && $this->_p['email'] == ''){
            Sis::Sesion()->flash("alerta", [
                'tipo' => 'error',
                'msg' => 'Por favor ingrese un el email con el cual se registró',
            ]);
        }
        
        $this->vista("recuperar", [
            'email' => $email,
        ]);
    }
    
    private function enviarEmail($email, $mensaje){
        $cabeceras = [
            "From:info@praxsis.com",
            "Content-type:text/html; charset=UTF-8",
            "Reply-To:info@praxsis.com",
            "MIME-Version: 1.0",
        ];
        mail($email, "Recuperación de contraseña", $mensaje, implode("\r\n", $cabeceras));
    }
    
    public function accionInicio(){    
        $this->plantilla = 'basica';        
        $this->mostrarVista('inicio');
    }

    public function accionAcerca(){
    	$this->mostrarVista("acerca");
    }

    public function accionContacto(){
    	$this->mostrarVista("contacto");
    }

    public function accionEntrar(){
        if(!Sis::apl()->usuario->esVisitante){
            $this->redireccionar('inicio');
        }
        
        if(isset($this->_p['login-usr']) && isset($this->_p['login-pwd'])){
            $comUsuario = new ComUsuario($this->_p['login-usr'], $this->_p['login-pwd']);
            $comUsuario->cargarConfiguracion();
            if($comUsuario->autenticar()){
                Sis::apl()->usuario->iniciarSesion($comUsuario->ID, $comUsuario->nombres);
                $this->redireccionar('inicio');
            }else {
                Sis::Sesion()->flash('alerta', [
                    'tipo' => 'error',
                    'msg' => 'Usuario o contraseña incorrectos',
                ]);
            }
        }
        
    	$this->mostrarVista("entrar");
    }

    public function accionSalir(){
        if(!Sis::apl()->usuario->esVisitante){
            Sis::apl()->usuario->cerrarSesion();
            $this->redireccionar("entrar");
        }
    	$this->redireccionar("inicio");
    }    
    
}
