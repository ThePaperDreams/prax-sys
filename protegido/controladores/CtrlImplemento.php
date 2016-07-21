<?php
/**
 * Este es el controlador Implemento, desde aquí se gestionan
 * todas las actividades que tengan que ver con Implemento
 * @author Jorge Alejandro Quiroz Serna <alejo.jko@gmail.com>
 * @version 1.0.0
 */
class CtrlImplemento extends CControlador{
    
    /**
     * Esta función muestra el inicio y una tabla para listar los datos
     */
    public function accionInicio(){
        $modelos = Implemento::modelo()->listar();
        $this->mostrarVista('inicio', ['modelos' => $modelos]);
    }
    
    /**
     * Esta función permite crear un nuevo registro
     */
    public function accionCrear(){
        $modelo = new Implemento();
        if(isset($this->_p['Implementos'])){
            $modelo->atributos = $this->_p['Implementos'];
            if($modelo->guardar()){
                # lógica para guardado exitoso
                $this->redireccionar('inicio');
            }
        }
        $this->mostrarVista('crear', [
            'modelo' => $modelo,
            'elementos' => CHtml::modeloLista(CategoriaImplemento::modelo()->listar(), "id_categoria", "nombre"),
        ]);
    }
    
     public function accionAnular($pk) {
        $modelo = $this->cargarModelo($pk);
        $modelo->estado_id = !$modelo->estado_id;
        if ($modelo->guardar()) {
            Sis::Sesion()->flash("alerta", [
                'msg' => 'Cambio exitoso',
                'tipo' => 'success',
            ]);
        } else {
            # lógica para error al borrar
        }
        $this->redireccionar('inicio');
    }
    /**
     * Esta función permite editar un registro existente
     * @param int $pk
     */
    public function accionEditar($pk){
        $modelo = $this->cargarModelo($pk);
        if(isset($this->_p['Implementos'])){
            $modelo->atributos = $this->_p['Implementos'];
            if($modelo->guardar()){
                # lógica para guardado exitoso
                $this->redireccionar('inicio');
            }
        }
        $this->mostrarVista('editar', [
            'modelo' => $modelo,
            'elementos' => CHtml::modeloLista(CategoriaImplemento::modelo()->listar(), "id_categoria", "nombre"),
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
    public function accionEliminar($pk){
        $modelo = $this->cargarModelo($pk);
        if($modelo->eliminar()){
            # lógica para borrado exitoso
        } else {
            # lógica para error al borrar
        }
        $this->redireccionar('inicio');
    }
    
    /**
     * Esta función permite cargar un modelo usando su primary key
     * @param int $pk
     * @return Implemento
     */
    private function cargarModelo($pk){
        return Implemento::modelo()->porPk($pk);
    }
}
