<?php

/**
 * Este es el controlador Opmenu, desde aquí se gestionan
 * todas las actividades que tengan que ver con Opmenu
 * @author Jorge Alejandro Quiroz Serna <alejo.jko@gmail.com>
 * @version 1.0.0
 */
class CtrlOpmenu extends CControlador {

    /**
     * Esta función muestra el inicio y una tabla para listar los datos
     */
    public function accionInicio() {
        $modelos = Opmenu::modelo()->listar();
        $this->mostrarVista('inicio', ['modelos' => $modelos]);
    }

    /**
     * Esta función permite crear un nuevo registro
     */
    public function accionCrear() {
        $modelo = new Opmenu();
        if (isset($this->_p['Opmenu'])) {
            $modelo->atributos = $this->_p['Opmenu'];
            if ($modelo->guardar()) {
                # lógica para guardado exitoso
                $this->redireccionar('inicio');
            }
        }
        $this->mostrarVista('crear', ['modelo' => $modelo,
            'rutas' => CHtml::modelolista(Ruta::modelo()->listar(), "id_ruta", "nombre"),
            'opmenus' => CHtml::modelolista(Opmenu::modelo()->listar(), "id", "texto"),
        ]);
    }

    /**
     * Esta función permite editar un registro existente
     * @param int $pk
     */
    public function accionEditar($pk) {
        $modelo = $this->cargarModelo($pk);
        if (isset($this->_p['Opmenu'])) {
            $modelo->atributos = $this->_p['Opmenu'];
            if ($modelo->guardar()) {
                # lógica para guardado exitoso
                $this->redireccionar('inicio');
            }
        }
        $this->mostrarVista('editar', ['modelo' => $modelo,
            'rutas' => CHtml::modelolista(Ruta::modelo()->listar(), "id_ruta", "nombre"),
            'opmenus' => CHtml::modelolista(Opmenu::modelo()->listar(), "id", "texto"),
        ]);
    }

    /**
     * Esta función permite ver detalladamente un registro existente
     * @param int $pk
     */
    public function accionVer($pk) {
        $modelo = $this->cargarModelo($pk);
        $this->mostrarVista('ver', ['modelo' => $modelo,
            'rutas' => CHtml::modelolista(Ruta::modelo()->listar(), "id_ruta", "nombre"),
            'opmenus' => CHtml::modeloLista(Opmenu::modelo()->listar(), "id", "texto"),
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
     * @return Opmenu
     */
    private function cargarModelo($pk) {
        return Opmenu::modelo()->porPk($pk);
    }

}
