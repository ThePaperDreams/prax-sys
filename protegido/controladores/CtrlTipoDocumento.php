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
        $this->validarNombre();
        $modelo = new TipoDocumento();
        if(isset($this->_p['TiposDocumento'])){
            $modelo->atributos = $this->_p['TiposDocumento'];
            if($modelo->guardar()){
                $this->alertar('success', 'Guardado Exitoso');                
                $this->redireccionar('inicio');
            }
        }
        $url = Sis::crearUrl(['TipoDocumento/crear']);
        $this->mostrarVista('crear', ['modelo' => $modelo,
            'url'=>$url,
            'tiposDocumentos' => CHtml::modelolista(TipoDocumento::modelo()->listar(), "id_tipo", "nombre"),
        ]);
    }
    
    private function alertar($tipo, $msj) {
        Sis::Sesion()->flash("alerta", [
            'msg' => $msj,
            'tipo' => $tipo,
        ]);
    }
    
    private function validarNombre($id = null){
        if(isset($this->_p['validarNombre'])){
            if($id === null){
                $criterio = [
                    'where' => "LOWER(nombre) = LOWER('" . $this->_p['nombre'] . "')"
                ];
            } else {
                $criterio = [
                    'where' => "id_tipo <> $id AND LOWER(nombre) = LOWER('" . $this->_p['nombre'] . "')"
                ];
            }
            $tipo_documento = TipoDocumento::modelo()->primer($criterio);
            if($tipo_documento != null){
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
    public function accionEditar($pk){
        $this->validarNombre($pk);
        $modelo = $this->cargarModelo($pk);
        if(isset($this->_p['TiposDocumento'])){
            $modelo->atributos = $this->_p['TiposDocumento'];
            if($modelo->guardar()){
                $this->alertar('success', 'Modificación exitosa');                
                $this->redireccionar('inicio');
            }
        }
        $url = Sis::crearUrl(['TipoDocumento/editar', 'id' => $pk]);
        $this->mostrarVista('editar', ['modelo' => $modelo,
            'url'=>$url,
            'tiposDocumentos' => CHtml::modelolista(TipoDocumento::modelo()->listar(["where" => "id_tipo != $modelo->id_tipo"]), "id_tipo", "nombre"),
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
        $doc = Documento::modelo()->listar([
            'where' => "tipo_id=$pk",
        ]);
        $tipodoc = TipoDocumento::modelo()->listar([
            'where' => "padre_id=$pk",
        ]);
        if(count($doc) > 0 || count($tipodoc) > 0){
            $this->alertar('error','No se puede eliminar');
        }else if($modelo->eliminar()){
            $this->alertar('success','Eliminación Exitosa');
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
