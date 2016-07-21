<?php
/**
 * Este es el controlador TipoDocumento, desde aquí se gestionan
 * todas las actividades que tengan que ver con TipoDocumento
 * @author Jorge Alejandro Quiroz Serna <alejo.jko@gmail.com>
 * @version 1.0.0
 */
class CtrlTipoDocumento extends CControlador{
    
    /**
     * Esta función muestra el inicio y una tabla para listar los datos
     */
    public function accionInicio(){
        $modelos = TipoDocumento::modelo()->listar();        
        $this->mostrarVista('inicio', ['modelos' => $modelos]);
    }
    
    /**
     * Esta función permite crear un nuevo registro
     */
    public function accionCrear(){
        $modelo = new TipoDocumento();
        if(isset($this->_p['TiposDocumento'])){
            $modelo->atributos = $this->_p['TiposDocumento'];
            if($modelo->guardar()){
                # lógica para guardado exitoso
                $this->redireccionar('inicio');
            }
        }
        $this->mostrarVista('crear', ['modelo' => $modelo,
            'tiposDocumentos' => CHtml::modelolista(TipoDocumento::modelo()->listar(), "id_tipo", "nombre"),
        ]);
    }
    
    /**
     * Esta función permite editar un registro existente
     * @param int $pk
     */
    public function accionEditar($pk){
        $modelo = $this->cargarModelo($pk);
        if(isset($this->_p['TiposDocumento'])){
            $modelo->atributos = $this->_p['TiposDocumento'];
            if($modelo->guardar()){
                # lógica para guardado exitoso
                $this->redireccionar('inicio');
            }
        }
        $this->mostrarVista('editar', ['modelo' => $modelo,
            'tiposDocumentos' => CHtml::modelolista(TipoDocumento::modelo()->listar(["where" => "id_tipo != $modelo->id_tipo"]), "id_tipo", "nombre"),
        ]);
    }
    
    /**
     * Esta función permite ver detalladamente un registro existente
     * @param int $pk
     */
    public function accionVer($pk){
        $modelo = $this->cargarModelo($pk);
        $this->mostrarVista('ver', ['modelo' => $modelo,
            'tiposDocumentos' => CHtml::modeloLista(TipoDocumento::modelo()->listar(), "id_tipo", "nombre"),
        ]);
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
     * @return TipoDocumento
     */
    private function cargarModelo($pk){
        return TipoDocumento::modelo()->porPk($pk);
    }
}
