<?php

/**
 * Este es el controlador Rol, desde aquí se gestionan
 * todas las actividades que tengan que ver con Rol
 * @author Jorge Alejandro Quiroz Serna <alejo.jko@gmail.com>
 * @version 1.0.0
 */
class CtrlRol extends CControlador {

    /**
     * Esta función muestra el inicio y una tabla para listar los datos
     */
    public function accionInicio() {
        $modelos = Rol::modelo()->listar();
        $this->mostrarVista('inicio', ['modelos' => $modelos]);
    }

    /**
     * Esta función permite crear un nuevo registro
     */
    public function accionCrear() {
        $this->validarNombre();
        $modelo = new Rol();
        if (isset($this->_p['Roles'])) {
            $modelo->atributos = $this->_p['Roles'];
            $modelo->nombre = trim($this->_p['Roles']['nombre']);
            if ($modelo->guardar()) {
                $this->alertar('success','Registro Exitoso');
                $this->redireccionar('inicio');
            }
        }
        $url = Sis::crearUrl(['Rol/crear']);
        $this->mostrarVista('crear', ['modelo' => $modelo,
            'url' => $url,
        ]);
    }

    private function validarNombre($id = null){
        if(isset($this->_p['validarNombre'])){
            if($id === null){
                $criterio = [
                    'where' => "nombre = '" . $this->_p['nombre'] . "'"
                ];
            } else {
                $criterio = [
                    'where' => "id_rol <> $id AND nombre = '" . $this->_p['nombre'] . "'"
                ];
            }
            $rol = Rol::modelo()->primer($criterio);
            if($rol != null){
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
    
    public function accionCambiarEstado($pk) {
        $modelo = $this->cargarModelo($pk);
        /*if ($modelo->estado == 0) {
            $this->alertar('warning', 'El Rol ya se encuentra inactivo');
            $this->redireccionar('inicio');
        }*/
        $usuario = Usuario::modelo()->listar([
            'where' => "rol_id=$pk",
        ]);
        if (count($usuario) > 0) {
            $this->alertar('error', 'No se puede Inactivar este Rol');
        } else {
            $modelo->estado = ($modelo->estado==1) ? 0: 1;
            if ($modelo->guardar()) {
                $this->alertar('success', 'Cambio de estado exitoso');
            }            
        }
        $this->redireccionar('inicio');
    }

    /**
     * Esta función permite editar un registro existente
     * @param int $pk
     */
    public function accionEditar($pk) {
        $this->validarNombre($pk);
        $modelo = $this->cargarModelo($pk);
        if (isset($this->_p['Roles'])) {
            $modelo->atributos = $this->_p['Roles'];
            $modelo->nombre = trim($this->_p['Roles']['nombre']);
            if ($modelo->guardar()) {
                # lógica para guardado exitoso
                $this->alertar('success','Actualización Exitosa');
                $this->redireccionar('inicio');
            }
        }
        $url = Sis::crearUrl(['Rol/editar', 'id' => $pk]);
        $this->mostrarVista('editar', ['modelo' => $modelo,
            'url' => $url,
        ]);
    }

    /**
     * Esta función permite ver detalladamente un registro existente
     * @param int $pk
     */
    public function accionVer($pk) {
        $modelo = $this->cargarModelo($pk);

        if(isset($this->_p['ajx']) && isset($this->_p['get-permisos'])){
            $this->consultarPermisosRol();
        }

        $modulos = Modulo::modelo()->listar();

        $this->mostrarVista('ver', [
            'modelo' => $modelo,
            'modulos' => $modulos,
        ]);
    }

    private function consultarPermisosRol(){
        $rol = $this->_p['rol'];
        $modulo = $this->_p['module'];

        $permisos = Rol::getPermisos($modulo, $rol);
        $json = [];
        foreach($permisos AS $r){
            $permiso = false;
            if($r->rol_id != "" && $r->estado == 1){
                # tiene permiso
                $permiso = true;
            } else if($r->rol_id != "" && $r->estado == 0){
                # no tiene permiso
            }

            $json[] = [
                'ruta' => $r->nombre_ruta,
                'permiso' => $permiso,
            ];
        }

        $this->json([
            'error' => false,
            'permisos' => $json,
        ]);

        Sis::fin();
    }

    /**
     * Esta función permite eliminar un registro existente
     * @param int $pk
     */
    /*public function accionEliminar($pk) {
        $modelo = $this->cargarModelo($pk);
        $rxr = RutaRol::modelo()->listar([
            'where' => "rol_id=$pk",
        ]);
        if(count($rxr) > 0){
            $this->alertar('error','No se puede eliminar');
        }else if($modelo->eliminar()){
            $this->alertar('success','Eliminación Exitosa');
        }
        $this->redireccionar('inicio');
    }*/    
    
    private function alertar($tipo, $msj) {
        Sis::Sesion()->flash("alerta", [
            'msg' => $msj,
            'tipo' => $tipo,
        ]);
    }

    /**
     * Esta función permite cargar un modelo usando su primary key
     * @param int $pk
     * @return Rol
     */
    private function cargarModelo($pk) {
        return Rol::modelo()->porPk($pk);
    }

}
