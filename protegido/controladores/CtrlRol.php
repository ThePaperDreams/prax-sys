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
        $modelo = new Rol();
        $ruta = new Ruta();
        $modulo = new Modulo();
        if (isset($this->_p['Roles'])) {
            $modelo->atributos = $this->_p['Roles'];
            if ($modelo->guardar()) {
                //$this->asociarRutas($modelo);
                $this->redireccionar('inicio');
            }
        }
        $url = Sis::crearUrl(['Rol/modulos']);
        $this->mostrarVista('crear', ['modelo' => $modelo,
            'ruta' => $ruta,
            'modulo' => $modulo,
            'url' => $url,
            'rutas' => CHtml::modelolista(Ruta::modelo()->listar(), "id_ruta", "nombre"),
            'modulos' => CHtml::modelolista(Modulo::modelo()->listar(), "id", "nombre"),
            'rutt' => Ruta::modelo()->listar(),
        ]);
    }
    
    public function accionModulos(){
        if (isset($this->_p['id'])) {
            $criterios = ["where" => "modulo_id = '" . $this->_p['id'] . "'"];
            $rutas = Ruta::modelo()->listar($criterios);
            //echo "<pre>";
            var_dump($rutas);
            //echo json_encode($rutas);
        }
    }

    /*public function asociarRutas($modelo, $rol = '') {
        if (isset($this->_p['Rutas'])) {
            $ultrol = ($rol === '') ? $modelo->primer(["order" => "id_rol desc"])->id_rol : $rol;
            foreach ($this->_p['Rutas'] as $v) {
                $modelo2 = new RutaRol();
                $modelo2->rol_id = $ultrol;
                $modelo2->ruta_id = $v;
                $modelo2->guardar();
            }
        }
    }*/

    /**
     * Esta función permite editar un registro existente
     * @param int $pk
     */
    public function accionEditar($pk) {
        $modelo = $this->cargarModelo($pk);
        $modelo2 = new Ruta();
        if (isset($this->_p['Roles'])) {
            $modelo->atributos = $this->_p['Roles'];
            if ($modelo->guardar()) {
                # lógica para guardado exitoso
                $this->asociarRutas($modelo, $pk);
                $this->redireccionar('inicio');
            }
        }
        $this->mostrarVista('editar', ['modelo' => $modelo,
            'modelo2'=>$modelo2,
            'rutas' => CHtml::modelolista(Ruta::modelo()->listar(), "id_ruta", "Datos"),
        ]);
    }

    /**
     * Esta función permite ver detalladamente un registro existente
     * @param int $pk
     */
    public function accionVer($pk) {
        $modelo = $this->cargarModelo($pk);
        $this->mostrarVista('ver', ['modelo' => $modelo]);
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
     * @return Rol
     */
    private function cargarModelo($pk) {
        return Rol::modelo()->porPk($pk);
    }

}
