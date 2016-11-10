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


    public function accionReporte(){
        if(!isset($this->_p['modelo'])){
            $this->redireccionar('inicio');
        }

        $this->tituloPagina = "Implementos praxis";
        $this->tituloPagina = str_replace(' ', '-', $this->tituloPagina);

        $campos = $this->_p['modelo'];
        foreach($campos AS $k=>$v){ $campos[$k] = $v == ''? null : $v; }

        $c = new CCriterio();
        
        $c->condicion("t1.nombre", $campos['categoria_id'], "LIKE")
           ->union("tbl_categorias_implementos", "t1")
           ->donde("t1.id_categoria", "=", "t.categoria_id")
           ->y("t.nombre", $campos['nombre'], "LIKE")     
           ->y("t.estado_id", $campos['estado_id'], "=")
           ->y("t.unidades", $campos['unidades'], "=")
           ->y("t.minimo_unidades", $campos['minimo_unidades'], "=");

        $implementos = Implemento::modelo()->listar($c);

        $this->plantilla = "reporte";
        $pdf = Sis::apl()->mpdf->crear();
        ob_start();
        $this->vista('reporte', ['implementos' => $implementos]);
        $texto = ob_get_clean();
        $pdf->writeHtml($texto);
        $pdf->Output("$this->tituloPagina.pdf", 'I');
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
