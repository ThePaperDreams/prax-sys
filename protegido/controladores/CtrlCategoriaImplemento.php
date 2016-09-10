<?php

/**
 * Este es el controlador CategoriaImplemento, desde aquí se gestionan
 * todas las actividades que tengan que ver con CategoriaImplemento
 * @author Jorge Alejandro Quiroz Serna <alejo.jko@gmail.com>
 * @version 1.0.0
 */
class CtrlCategoriaImplemento extends CControlador {

    /**
     * Esta función muestra el inicio y una tabla para listar los datos
     */
    public function accionInicio() {
        $modelos = CategoriaImplemento::modelo()->listar();
        $this->mostrarVista('inicio', ['modelos' => $modelos]);
    }

    /**
     * Esta función permite crear un nuevo registro
     */
    public function accionCrear() {
        $this->validarNombre();       
        $modelo = new CategoriaImplemento();
        if (isset($this->_p['CategoriasImplementos'])) {
            $modelo->atributos = $this->_p['CategoriasImplementos'];
            if ($modelo->guardar()) {
                Sis::Sesion()->flash("alerta", [
                    'msg' => 'Guardado exitoso',
                    'tipo' => 'success',
                ]);
                $this->redireccionar('inicio');
            }
        }
        $urlAjx = Sis::crearUrl(['CategoriaImplemento/crear']);
        $this->mostrarVista('crear', ['modelo' => $modelo, 'url' => $urlAjx]);
    }

    /**
     * Esta función permite editar un registro existente
     * @param int $pk
     */
    public function accionEditar($pk) {
        $this->validarNombre($pk);
        $modelo = $this->cargarModelo($pk);
        if (isset($this->_p['CategoriasImplementos'])) {
            $modelo->atributos = $this->_p['CategoriasImplementos'];
            if ($modelo->guardar()) {
                Sis::Sesion()->flash("alerta", [
                    'msg' => 'Modificación exitosa',
                    'tipo' => 'success',
                ]);
                $this->redireccionar('inicio');
            }
        }
        $urlAjx = Sis::crearUrl(['CategoriaImplemento/editar', 'id' => $pk]);
        $this->mostrarVista('editar', ['modelo' => $modelo, 'url' => $urlAjx]);
    }

    private function validarNombre($id = null){
        if(isset($this->_p['validarNombre'])){
            if($id === null){
                $criterio = [
                    'where' => "LOWER(nombre) = LOWER('" . $this->_p['nombre'] . "')"
                ];
            } else {
                $criterio = [
                    'where' => "id_categoria <> $id AND LOWER(nombre) = LOWER('" . $this->_p['nombre'] . "')"
                ];
            }
            $categoria = CategoriaImplemento::modelo()->primer($criterio);
            
            if($categoria != null){
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
     * Esta función permite ver detalladamente un registro existente
     * @param int $pk
     */
    public function accionVer($pk) {
        $modelo = $this->cargarModelo($pk);
        $this->mostrarVista('ver', ['modelo' => $modelo]);
    }

    public function accionAnular($pk) {
        $modelo = $this->cargarModelo($pk);
        
        //$modelo->estado = !$modelo->estado;
        $modelo->estado = $modelo->estado ? 0 : 1;
        if ($modelo->guardar()) {
                Sis::Sesion()->flash("alerta", [
                    'msg' => 'Cambio exitoso',
                    'tipo' => 'success',
                ]);
        } else {
            
        }
        $this->redireccionar('inicio');
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
     * @return CategoriaImplemento
     */
    private function cargarModelo($pk) {
        return CategoriaImplemento::modelo()->porPk($pk);
    }

}
