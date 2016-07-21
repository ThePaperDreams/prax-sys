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
        $modelo = new Usuario();
        if (isset($this->_p['Usuarios'])) {
            $modelo->atributos = $this->_p['Usuarios'];
            $modelo->clave = sha1($this->_p['Usuarios']['clave']);
            if ($modelo->guardar()) {
                # lógica para guardado exitoso
                $this->redireccionar('inicio');
            }
        }
        $this->mostrarVista('crear', ['modelo' => $modelo,
            'roles' => CHtml::modelolista(Rol::modelo()->listar(), "id_rol", "nombre"),
        ]);
    }

    /**
     * Esta función permite editar un registro existente
     * @param int $pk
     */
    public function accionEditar($pk) {
        $modelo = $this->cargarModelo($pk);
        if (isset($this->_p['Usuarios'])) {
            $modelo->atributos = $this->_p['Usuarios'];
            $modelo->clave = sha1($this->_p['Usuarios']['clave']);
            if ($modelo->guardar()) {
                # lógica para guardado exitoso
                $this->redireccionar('inicio');
            }
        }
        $this->mostrarVista('editar', ['modelo' => $modelo,
            'roles' => CHtml::modelolista(Rol::modelo()->listar(), "id_rol", "nombre"),
        ]);
    }

    /**
     * Esta función permite ver detalladamente un registro existente
     * @param int $pk
     */
    public function accionVer($pk) {
        $modelo = $this->cargarModelo($pk);
        $this->mostrarVista('ver', ['modelo' => $modelo,
            'roles' => CHtml::modelolista(Rol::modelo()->listar(), "id_rol", "nombre"),
        ]);
    }

    /**
     * Esta función permite eliminar un registro existente
     * @param int $pk
     */
    public function accionEliminar($pk) {
        $modelo = $this->cargarModelo($pk);
        if ($modelo->eliminar()) {
            # lógica para borrado exitoso
        } else {
            # lógica para error al borrar
        }
        $this->redireccionar('inicio');
    }

    /**
     * Esta función permite cargar un modelo usando su primary key
     * @param int $pk
     * @return Usuario
     */
    private function cargarModelo($pk) {
        return Usuario::modelo()->porPk($pk);
    }

}
