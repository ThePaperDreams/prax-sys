<?php

class CtrlPrincipal extends CControlador{
    
    private function alertar($tipo, $msj){
        Sis::Sesion()->flash("alerta", [
                'msg' => $msj,
                'tipo' => $tipo,
        ]);
    }
    
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
    
    private function generarLinkTemporal($idusuario, $username) {
        // Se genera una cadena para validar el cambio de contraseña
        $cadena = $idusuario . $username . rand(1, 9999999) . date('Y-m-d');
        $token = sha1($cadena);

        //$conexion = new mysqli('localhost', 'root', '', 'ejemplobd');
        // Se inserta el registro en la tabla tblreseteopass
        //$sql = "INSERT INTO tblreseteopass (idusuario, username, token, creado) VALUES($idusuario,'$username','$token',NOW());";
        $ins = new ReseteoPassword();
        $ins->idusuario=$idusuario;
        $ins->username=$username;
        $ins->token=$token;
        $ins->creado= date("Y-m-d H:i:s");
        
        //$resultado = $conexion->query($sql);
        if ($ins->guardar()) {
            $enlace= Sis::CrearUrl(['principal/restablecer', 'idusuario' => sha1($idusuario), 'token' => $token ]);
            // Se devuelve el link que se enviara al usuario
            //$enlace = $_SERVER["SERVER_NAME"] . '/principal/restablecer/idusuario=' . sha1($idusuario) . '&token=' . $token; // aqui vamos
            return $enlace;
        } else{
            return FALSE;
        }
    }

    private function enviarEmail($email, $link) {
        $mensaje = '<html>
        <head>
           <title>Restablece tu contraseña</title>
        </head>
        <body>
          <p>Hemos recibido una petición para restablecer la contraseña de tu cuenta.</p>
          <p>Si hiciste esta petición, haz clic en el siguiente enlace, si no hiciste esta petición puedes ignorar este correo.</p>
          <p>
            <strong>Enlace para restablecer tu contraseña</strong><br>
            <a href="' . $link . '"> Restablecer contraseña </a>
          </p>
        </body>
       </html>';

        $cabeceras = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $cabeceras .= 'From: Codedrinks <mimail@codedrinks.com>' . "\r\n";
        // Se envia el correo al usuario
        mail($email, "Recuperar contraseña", $mensaje, $cabeceras);
    }
    
    public function accionRecuperarClave() {
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
            $respuesta = new stdClass();
            //$conexion = new mysqli('localhost', 'root', '', 'prax');
            //$sql = " SELECT * FROM users WHERE email = '$email' ";
            //$resultado = $conexion->query($sql);
            $cr = new CCriterio();
            $cr->condicion("t.email", $email, "=");
            $usuario = Usuario::modelo()->primer($cr);
            if (count($usuario) > 0) {
                //$usuario = $resultado->fetch_assoc();
                $linkTemporal = $this->generarLinkTemporal($usuario->id_usuario, $usuario->nombre_usuario);
                if ($linkTemporal) {
                    $this->enviarEmail($email, $linkTemporal);
                    $respuesta->mensaje = '<div class="alert alert-info"> Un correo ha sido enviado a su cuenta de email con las instrucciones para restablecer la contraseña </div>';
                } else {
                    $respuesta->mensaje = '<div class="alert alert-warning"> No existe una cuenta asociada a ese correo. </div>';
                }
            } else {
                $respuesta->mensaje = "Debes introducir el email de la cuenta";
                echo json_encode($respuesta);
            }
        }
        $this->plantilla = "login";
        $this->mostrarVista("recuperarClave");
    }

    public function accionRestablecer() {
        //$token = $_GET['token'];
        $token = $this->_g['token'];
        //$idusuario = $_GET['idusuario'];
        $idusuario = $this->_g['idusuario'];
        
        $cr = new CCriterio();
        $cr->condicion("t.token", $token, "=");
        $usuario = ReseteoPassword::modelo()->listar($cr);

        /* $conexion = new mysqli('localhost', 'root', '', 'ejemplobd');

          $sql = "SELECT * FROM tblreseteopass WHERE token = '$token'";
          $resultado = $conexion->query($sql); */

        if (count($usuario) > 0) {
            //$usuario = $resultado->fetch_assoc();
            if (sha1($usuario->idusuario) == $idusuario) {
                $this->mostrarVista('restablecer', ['token' => $token,
                    'idusuario' => $idusuario,
                ]);
            } else {
                $this->alertar('error','Token Inválido');
                $this->redireccionar('inicio');
            }
        } else {
           $this->alertar('error','Token Inválido');
           $this->redireccionar('inicio');
        }  
    }
    
    public function accionCambiarContrasena(){
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        $idusuario = $_POST['idusuario'];
        $token = $_POST['token'];

        if ($password1 != "" && $password2 != "" && $idusuario != "" && $token != "") {
            $cr = new CCriterio();
            $cr->condicion("t.token", $token, "=");
            $usuario = ReseteoPassword::modelo()->primer($cr);
            if (count($usuario)> 0) {
                if (sha1($usuario->idusuario === $idusuario)) {
                    if ($password1 === $password2) {
                        $user = new Usuario();
                        $user->porPk($usuario->idusuario);
                        $user->clave= sha1($password1);
                        //$sql = "UPDATE users SET password = '" . sha1($password1) . "' WHERE id = " . $usuario['idusuario'];
                        //$resultado = $conexion->query($sql);
                        if ($user->guardar()) {
                            $usuario->eliminar();
                            /*$sql = "DELETE FROM tblreseteopass WHERE token = '$token';";
                            $resultado = $conexion->query($sql);*/
                            $this->alertar('success','La contraseña se actualizó con exito.');
                        } else {
                            $this->alertar('error','Ocurrió un error al actualizar la contraseña, intentalo más tarde.');
                        }
                    } else {
                        $this->alertar('error','Las contraseñas no coinciden.');
                    }
                } else {
                        $this->alertar('error','Token Inválido');
                }
            } else {
                    $this->alertar('error','Token Inválido');
            }
        } else {
            $this->redireccionar('inicio');
        }
    }
}
