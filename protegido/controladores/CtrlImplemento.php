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
        $this->validarNombre();
        $modelo = new Implemento();
        if(isset($this->_p['Implementos'])){
            $modelo->atributos = $this->_p['Implementos'];
            $modelo->maximo_unidades = $modelo->unidades;
            if($modelo->guardar()){
                Sis::Sesion()->flash("alerta", [
                    'msg' => 'Guardado exitoso',
                    'tipo' => 'success',
                ]);
                $this->redireccionar('inicio');
            }
        }
        $urlAjx = Sis::crearUrl(['Implemento/crear']);
        $this->mostrarVista('crear', [
            'modelo' => $modelo,
            'url'=>$urlAjx,
            'elementos' => CHtml::modeloLista(CategoriaImplemento::modelo()->listar(), "id_categoria", "nombre"),
            
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
                    'where' => "id_implemento <> $id AND LOWER(nombre) = LOWER('" . $this->_p['nombre'] . "')"
                ];
            }
            $implemento = Implemento::modelo()->primer($criterio);
            
            if($implemento != null){
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
    
     public function accionAnular($pk) {
        $modelo = $this->cargarModelo($pk);
        $modelo->estado_id = $modelo->estado_id == 1? 2 : 1;
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
        $this->validarNombre($pk);
        $modelo = $this->cargarModelo($pk);
        if(isset($this->_p['Implementos'])){
            $modelo->atributos = $this->_p['Implementos'];
            $modelo->maximo_unidades = $modelo->unidades;
            if($modelo->guardar()){
                Sis::Sesion()->flash("alerta", [
                    'msg' => 'Modificación exitosa',
                    'tipo' => 'success',
                ]);
                $this->redireccionar('inicio');
            }
        }
        $urlAjx = Sis::crearUrl(['Implemento/editar', 'id' => $pk]);
        $this->mostrarVista('editar', [
            'modelo' => $modelo,
            'url'=>$urlAjx,
            'elementos' => CHtml::modeloLista(CategoriaImplemento::modelo()->listar(), "id_categoria", "nombre"),
        ]);
        
        
    }
    public function accionGenerarReporte(){
        $implementos =  Implemento::modelo()->listar([
            'where'=>'estado_id=1',
        ]);
        $pdf = Sis::apl()->mpdf->crear();
        $texto =  $this->vistaP('pdfImplemento',['implementos'=>$implementos]);
        $pdf->writeHtml($texto);
        $pdf->output("Implementos.pdf",'I');
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
