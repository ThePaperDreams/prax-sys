<?php
/**
 * Este es el controlador Ruta, desde aquí se gestionan
 * todas las actividades que tengan que ver con Ruta
 * @author Jorge Alejandro Quiroz Serna <alejo.jko@gmail.com>
 * @version 1.0.0
 */
class CtrlRuta extends CControlador{
    
    /**
     * Esta función muestra el inicio y una tabla para listar los datos
     */
    public function accionInicio(){
        $modelos = Ruta::modelo()->listar();        
        $this->mostrarVista('inicio', ['modelos' => $modelos]);
    }
    
    /**
     * Esta función permite crear un nuevo registro
     */
    public function accionCrear(){
        $this->validarNombreRuta();
        $modelo = new Ruta();
        if(isset($this->_p['Rutas'])){
            $modelo->atributos = $this->_p['Rutas'];
            if($modelo->guardar()){
                # lógica para guardado exitoso
                $this->alertar('success', 'Registro exitoso');
                $this->redireccionar('inicio');
            }
        }
        $url = Sis::crearUrl(['Ruta/crear']);
        $this->mostrarVista('crear', ['modelo' => $modelo,
            'url' => $url,
            'modulos' => CHtml::modelolista(Modulo::modelo()->listar(), "id", "nombre"),
            ]);
    }
    
    private function validarNombreRuta($id = null){
        if(isset($this->_p['validarNombreRuta'])){
            if($id === null){
                $criterio = [
                    'where' => "nombre = '" . $this->_p['nombre'] . "' OR ruta = '" . $this->_p['ruta'] . "'"
                ];
            } else {
                $criterio = [
                    'where' => "id_ruta <> $id AND nombre = '" . $this->_p['nombre'] . "' OR ruta = '" . $this->_p['ruta'] . "'"
                ];
            }
            $ruta = Ruta::modelo()->primer($criterio);
            if($ruta != null){
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
    
    private function alertar($tipo, $msj) {
        Sis::Sesion()->flash("alerta", [
            'msg' => $msj,
            'tipo' => $tipo,
        ]);
    }
    
    /**
     * Esta función permite editar un registro existente
     * @param int $pk
     */
    public function accionEditar($pk){
        $this->validarNombreRuta($pk);
        $modelo = $this->cargarModelo($pk);
        if(isset($this->_p['Rutas'])){
            $modelo->atributos = $this->_p['Rutas'];
            if($modelo->guardar()){
                # lógica para guardado exitoso
                $this->alertar('success', 'Registro exitoso');
                $this->redireccionar('inicio');
            }
        }
        $url = Sis::crearUrl(['Ruta/editar', 'id' => $pk]);
        $this->mostrarVista('editar', ['modelo' => $modelo,
            'url' => $url,
            'modulos' => CHtml::modelolista(Modulo::modelo()->listar(), "id", "nombre"),
            ]);
    }
    
    /**
     * Esta función permite ver detalladamente un registro existente
     * @param int $pk
     */
    public function accionVer($pk){
        $modelo = $this->cargarModelo($pk);
        $this->mostrarVista('ver', ['modelo' => $modelo]);
    }
    
    /**
     * Esta función permite eliminar un registro existente
     * @param int $pk
     */
    public function accionEliminar($pk) {
        $modelo = $this->cargarModelo($pk);
        $rutas = RutaRol::modelo()->listar([
            'where' => "ruta_id=$pk",
        ]);
        if (count($rutas) > 0) {
            $this->alertar('error', 'No se puede eliminar');
        } else {
            if ($modelo->eliminar()) {
                $this->alertar('success', 'Ruta eliminada');
            }
        }
        $this->redireccionar('inicio');
    }

    /**
     * Esta función permite cargar un modelo usando su primary key
     * @param int $pk
     * @return Ruta
     */
    private function cargarModelo($pk){
        return Ruta::modelo()->porPk($pk);
    }
}
