<?php

class CtrlPrincipal extends CControlador{
    
    public function inicializar() {
        parent::inicializar();
    }
    
    public function accionEjemplo(){
        $this->plantilla = "basica";
        $this->vista('ejemploFormularios');
    }
    
    public function accionInicio(){        
        # instanciamos el pdf
//        $pdf = Sis::apl()->mpdf->crear();
        # obtenemos el html generado por una vista y lo guardamos en un string
//        $texto = $this->vistaP('prueba');
        # Imprimimos el html
//        $pdf->writeHtml($texto);
        # Enviar el archivo pdf
//        $pdf->Output();
//        Sis::fin();
        
        $this->mostrarVista('inicio');
    }

    public function accionAcerca(){
    	$this->mostrarVista("acerca");
    }

    public function accionContacto(){
    	$this->mostrarVista("contacto");
    }

    public function accionEntrar(){
        $this->plantilla = "login";
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
