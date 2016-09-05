<?php

/**
 * Este es el controlador Usuario, desde aquí se gestionan
 * todas las actividades que tengan que ver con Usuario
 * @author Jorge Alejandro Quiroz Serna <alejo.jko@gmail.com>
 * @version 1.0.0
 */
class CtrlUsuario extends CControlador {

    /**
     * Esta función muestra el inicio y una tabla para listar los datos
     */
    public function accionInicio() {
        $modelos = Usuario::modelo()->listar();
        $this->mostrarVista('inicio', ['modelos' => $modelos]);
    }

    /**
     * Esta función permite crear un nuevo registro
     */
    public function accionCrear() {
        $this->validarUsuarioEmail();
        $modelo = new Usuario();
        /*echo "<pre>";
        var_dump($this->_p, $_FILES['Usuarios']);
        exit();*/
        if (isset($this->_p['Usuarios'])) {
            $modelo->atributos = $this->_p['Usuarios'];
            $modelo->nombre_usuario = trim($this->_p['Usuarios']['nombre_usuario']);
            $modelo->email = trim($this->_p['Usuarios']['email']);
            $modelo->foto = $this->guardarFoto($modelo->nombre_usuario);
            $modelo->clave = sha1($this->_p['Usuarios']['uclave']);
            if ($modelo->guardar()) {
                # lógica para guardado exitoso                
                $this->alertar('success','Registro Exitoso');
                $this->redireccionar('inicio');
            }
        }
        $url = Sis::crearUrl(['Usuario/crear']);
        $this->mostrarVista('crear', ['modelo' => $modelo,
            'url' => $url,
            'roles' => CHtml::modeloLista(Rol::modelo()->listar(), 'id_rol', 'nombre'),
        ]);
    }
    
    public function guardarFoto($usuario) {
        if ($_FILES['Usuarios']['error'] !== UPLOAD_ERR_OK) {
            $files = CArchivoCargado::instanciarModelo('Usuarios', 'foto');
            $rutaDestino = Sis::resolverRuta(Sis::crearCarpeta("!publico.imagenes.usuarios"));
            $rutaThumbs = Sis::resolverRuta(Sis::crearCarpeta("!publico.imagenes.usuarios.thumbs"));
            $nom = "Foto_$usuario";
            if ($files->guardar($rutaDestino, $nom)) {
                $files->thumbnail($rutaThumbs, [
                    'tamanio' => '400',
                    'tipo' => strtolower($files->getExtension()),
                ]);
            }
            $nom .= "." . $files->getExtension();
            return $nom;
        } else {
            return "";
        }
    }

    private function validarUsuarioEmail($id = null){
        if(isset($this->_p['validarUsuarioEmail'])){
            if($id === null){
                $criterio = [
                    'where' => "nombre_usuario = '" . $this->_p['usuario'] . "' OR email = '" . $this->_p['email'] . "'",
                ];
            } else {
                $criterio = [
                    'where' => "(id_usuario <> $id) AND (nombre_usuario = '" . $this->_p['usuario'] . "' OR email = '" . $this->_p['email'] . "')",
                ];
            }
            $usuario = Usuario::modelo()->primer($criterio);
            if($usuario != null){
                $error = true;
            } else {
                $error = false;
            }
            $this->json([
                'error' => $error,
            ]);
            Sis::fin();
        }
    }

    /**
     * Esta función permite editar un registro existente
     * @param int $pk
     */
    public function accionEditar($pk) {
        $this->validarUsuarioEmail($pk);
        $modelo = $this->cargarModelo($pk);
        if (isset($this->_p['Usuarios'])) {
            $modelo->atributos = $this->_p['Usuarios'];
            $modelo->nombre_usuario = trim($this->_p['Usuarios']['nombre_usuario']);
            $modelo->email = trim($this->_p['Usuarios']['email']);
            $modelo->foto = $this->guardarFoto($modelo->nombre_usuario);
            if ($this->_p['cambio-clave'] === "1") {
                $modelo->clave = sha1($this->_p['Usuarios']['uclave']);                
            }
            if ($modelo->guardar()) {
                # lógica para guardado exitoso
                $this->alertar('success','Actualización Exitosa');
                $this->redireccionar('inicio');
            }
        }
        $url = Sis::crearUrl(['Usuario/editar', 'id' => $pk]);
        $this->mostrarVista('editar', ['modelo' => $modelo,
            'url' => $url,
            'roles' => CHtml::modeloLista(Rol::modelo()->listar(), 'id_rol', 'nombre'),
        ]);
    }

    public function accionEditarPerfil() {
        $modelo = $this->cargarModelo(Sis::apl()->usuario->getID());
        
        if(isset($this->_p['ajx'])){
            $modelo->atributos = $this->_p['ficha'];
            $this->json([
                'error' => !$modelo->guardar(),
            ]);
            Sis::fin();
        } 
        
        $modelo->nombres = trim($this->_p['ficha']['nombres']);
        $modelo->apellidos = trim($this->_p['ficha']['apellidos']);
        $modelo->telefono = trim($this->_p['ficha']['telefono']);
        $modelo->guardar();
        $url = Sis::crearUrl(['Usuario/editarPerfil', Sis::apl()->usuario->getID]);
        $this->mostrarVista('perfil', ['modelo' => $modelo,
            'url' => $url,
            'roles' => CHtml::modeloLista(Rol::modelo()->listar(), 'id_rol', 'nombre'),
        ]);
    }
    
    public function accionCambiarFoto(){
        $imagen = CArchivoCargado::instanciarPorNombre('imagenes');
        $rutaDes = Sis::resolverRuta(Sis::crearCarpeta("!publico.imagenes.usuarios"));
        $rutaThumbs = Sis::resolverRuta(Sis::crearCarpeta("!publico.imagenes.usuarios.thumbs"));
        $guardado = $imagen->guardar($rutaDes);
        $error = true;
        if($guardado){
            $imagen->thumbnail($rutaThumbs, [
                'tamanio' => 200,
                'autocentrar' => true,
                'tipo' => strtolower($imagen->getExtension()),
            ]);
            $mImagen = $this->cargarModelo(Sis::apl()->usuario->getID());
            $mImagen->foto = $imagen->getNombreOriginal();
            $mImagen->guardar();            
            $error = false;
        }
        
        header("Content-type: Application/json");
        
        echo json_encode([
            'uploadErr' => $error,
            'url' => Sis::UrlBase() . "/publico/imagenes/usuarios/$mImagen->foto",
        ]);
        Sis::fin();
        
    }
    /**
     * Esta función permite ver detalladamente un registro existente
     * @param int $pk
     */
    public function accionVer($pk) {
        $modelo = $this->cargarModelo($pk);
        $this->mostrarVista('ver', ['modelo' => $modelo,
        ]);
    }
    
    public function accionVerPerfil($pk) {
        $modelo = $this->cargarModelo(Sis::apl()->usuario->getID());
        $this->mostrarVista('perfil', ['modelo' => $modelo,
        ]);
    }

    public function accionCambiarEstado($pk) {
        $modelo = $this->cargarModelo($pk);
        if ($modelo->estado == 0) {
            $this->alertar('warning', 'El Usuario ya se encuentra inactivo');
            $this->redireccionar('inicio');
        }
        $modelo->estado = !$modelo->estado;
        if ($modelo->guardar()) {
            $this->alertar('success','Cambio de estado exitoso');
        }
        $this->redireccionar('inicio');
    }    
    
    private function alertar($tipo, $msj){
        Sis::Sesion()->flash("alerta", [
                'msg' => $msj,
                'tipo' => $tipo,
        ]);
    }
    
    /**
     * Esta función permite eliminar un registro existente
     * @param int $pk
     */
    /*public function accionEliminar($pk) {
        $modelo = $this->cargarModelo($pk);
        if ($modelo->eliminar()) {
            # lógica para borrado exitoso
        } else {
            # lógica para error al borrar
        }
        $this->redireccionar('inicio');
    }*/

    /**
     * Esta función permite cargar un modelo usando su primary key
     * @param int $pk
     * @return Usuario
     */
    private function cargarModelo($pk) {
        return Usuario::modelo()->porPk($pk);
    }

}
