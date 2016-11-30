<?php

class CtrlPrincipal extends CControlador{
    private $multiplo = 1212;
    
    private function alertar($tipo, $msj){
        Sis::Sesion()->flash("alerta", [
                'msg' => $msj,
                'tipo' => $tipo,
        ]);
    }

    
    public function inicializar() {
        parent::inicializar();
        $this->plantilla = 'login';
        # nos aseguramos que no se creen las migas de pan en la navegación
        # Esto ayuda a que este método no interrumpa con la navegación de urls
        if($_GET['r'] == 'principal/ajx'){ Sis::apl()->setMigas("false"); }
    }


    public function accionConfiguracion(){
        if(isset($this->_p['ajx_rqst'])){
            $guardado = $this->guardarConfiguraciones();
            $msg = $guardado? "Se guardaron correctamente las configuraciones" : "Ocurrió un error";
            $this->json([
                'error' => !$guardado,
                'msg'   => $msg,
            ]);
            Sis::fin();
        }
        $this->plantilla = 'basica';        
        $this->vista("configuracion");
    }

    private function guardarConfiguraciones(){
        return Configuracion::set("redes_facebook", $this->_p['facebook']) && 
            Configuracion::set("redes_twitter", $this->_p['twitter']) && 
            Configuracion::set("redes_instagram", $this->_p['instagram']) && 
            Configuracion::set("redes_youtube", $this->_p['youtube']) &&
            Configuracion::set("email_admin", $this->_p['email_admin']) && 
            Configuracion::set("quienes_somos", $this->_p['qs']);
    }

    public function accionAjx(){
        if(!isset($this->_p['ajx-rqst'])){
            Sis::fin();
        }
        $this->json([
            'total' => count(Sis::apl()->Utilidades->getNotificaciones()),
            'notificaciones' => Sis::apl()->Utilidades->getNotificaciones(),
        ]);
    }

    public function accionTest(){
        Sis::ap()->log->escribir("Saludo");
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
                $msg = 'Se ha enviado un email a la dirección de correo electrónico ingresada.';
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
    
    public function accionInicio(){
        $this->plantilla = 'basica';

        $data = Visita::getDataDash();

        $this->mostrarVista('inicio', [
            'labels' => implode(',', $data['labels']),
            'data' => implode(',', $data['data']),
        ]);
    }

    public function accionMapaNavegacion(){
        if(isset($this->_p['ajx_rq'])){
            $this->consultarHijosNavegacion();
            Sis::fin();
        }

        $this->plantilla = "basica";
        $c = new CCriterio();
        $c->esVacio("padre_id");
        $padres = MapaNavegacion::modelo()->listar($c);
        $this->vista("mapaNavegacion", [
            'padres' => $padres
        ]);
    }

    private function consultarHijosNavegacion(){
        $c = new CCriterio();
        $c->condicion("padre_id", $this->_p['id']);
        $opciones = MapaNavegacion::modelo()->listar($c);
        $json = [];
        foreach($opciones AS $k=>$v){
            $json[] = ['id' => $v->id_opcion, 'nombre' => $v->nombre];
        }
        $this->json([
            'error' => false,
            'items' => $json,
        ]);
    }

    public function accionSobre(){
        $this->plantilla = 'basica';    
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
        $asunto = "Recuperación de contraseña";
        $mensaje = $this->vistaP('_emailRecuperar', ['url' => $link]);
        return Sis::apl()->JMail->enviar($email, $asunto, $mensaje);     
    }
    
    public function accionRestablecerClave(){
        if(!isset($this->_g['t'])){ $this->redireccionar("entrar"); }
        $id = $this->desencriptarIdUsuario($this->_g['t']);
        $c = new CCriterio();
        $c->condicion("id_usuario", $id)
                ->y("url_recuperacion", $this->_g['t']);        
        $usuario = Usuario::modelo()->primer($c);
        if(isset($this->_p['recuperar-pwd'])){
            $this->cambiarClave($usuario);
        }
        if($usuario !== null){
            $this->plantilla = "login";
            $this->mostrarVista('restablecer', ['token' => $this->_g['t'], 'idusuario' => $id]);
        } else {
            $this->redireccionar("entrar");
        }        
    }
    
    /**
     * @param Usuario $usuario
     */
    private function cambiarClave(&$usuario){
        $usuario->clave = sha1($this->_p['recuperar-pwd']);
        $usuario->url_recuperacion = null;
        $usuario->recuperacion = null;
        if($usuario->guardar()){
            Sis::Sesion()->flash("alerta", [
                'tipo' => 'success',
                'msg' => 'Se ha cambiado exitosamente la contraseña',
            ]);
        } else {
            Sis::Sesion()->flash("alerta", [
                'tipo' => 'error',
                'msg' => 'Ocurrió un error al cambiar la contraseña',
            ]);
        }
        $this->redireccionar('entrar');
    }
    
    public function accionRecuperarClave() {
        if (isset($this->_p['email'])) {
            $c = new CCriterio();
            $c->condicion('email', $this->_p['email']);
            # listamos el usuario que tenga ese email
            $usuario = Usuario::modelo()->primer($c);
            if($usuario !== null && $usuario->recuperacion != '1'){
                $url = $this->generarUrlRecuperacion($usuario);
                $usuario->url_recuperacion = $url;
                $usuario->recuperacion = 1;
                $usuario->guardar();
                if($this->enviarEmail($usuario->email, $url)){
                    $this->alertar('success','Se ha enviado un email con instrucciones para la modificación de contraseña.');
                    $this->redireccionar("entrar");
                }
            } else if($usuario == null){
                $this->alertar("error", "No existe un usuario asociado a el email ingresado");
            } else if($usuario->recuperacion == '1'){
                $this->alertar("error", "Ya se ha enviado un email de recuperación a esta dirección de correo");
            }
        }
        $this->plantilla = "login";
        $this->mostrarVista("recuperarClave");
    }
    
    /**
     * Esta función permite generar el link de recuperación de un usuario usando un hash
     * @param Usuario $usuario
     */
    private function generarUrlRecuperacion(&$usuario){
        $relleno = base64_encode(time());
        $distraccion = rand(0, 100);
        $tokken = $this->encriptarIdUsuario($usuario->id_usuario, $distraccion);
        $url = "$relleno#$tokken#" . base64_encode($distraccion);
        return $url;
    }
    
    private function encriptarIdUsuario($id, $mascara){
        return base64_encode((intval($id) * $this->multiplo) + $mascara) ;
    }
    
    private function desencriptarIdUsuario($tokken){
        $partes = explode("#", $tokken);
        $tmpId = base64_decode($partes[1]);
        $distraccion = base64_decode($partes[2]);
        $id = (intval($tmpId) - intval($distraccion)) / $this->multiplo;
        return $id;
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
                $this->redireccionar('entrar');
            }
        } else {
           $this->alertar('error','Token Inválido');
           $this->redireccionar('entrar');
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
