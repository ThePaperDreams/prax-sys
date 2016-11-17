<?php

/**
 * Este es el controlador Acudiente, desde aquí se gestionan
 * todas las actividades que tengan que ver con Acudiente
 * @author Jorge Alejandro Quiroz Serna <alejo.jko@gmail.com>
 * @version 1.0.0
 */
class CtrlAcudiente extends CControlador {
    public $ayuda;
    public $ayudaTitulo;
    private $tipoDocDef = 1;
    /**
     * Esta función muestra el inicio y una tabla para listar los datos
     */
    public function accionInicio() {
        $modelos = Acudiente::modelo()->listar();
        $this->mostrarVista('inicio', ['modelos' => $modelos,
        ]);
    }

    public function accionReporte(){
        if(!isset($this->_p['modelo'])){
            $this->redireccionar('inicio');
        }

        $this->tituloPagina = "Acudientes - praxis";
        $campos = $this->_p['modelo'];
        foreach($campos AS $k=>$v){ $campos[$k] = $v == ''? null : $v; }

        $c = new CCriterio();
        $concat = "CONCAT_WS(' ', t.nombre1,t.nombre2,t.apellido1,t.apellido2)";
        $c->condicion($concat, $campos['_nombreCompleto'], "LIKE")
            ->y("t.identificacion", $campos['identificacion'], "LIKE")
            ->y("telefono1", $campos['telefono1'], "LIKE")
            ->y("telefono2", $campos['telefono2'], "LIKE")
            ->y("t.estado", $campos['estado'], "LIKE")
            ->orden("t.estado = 1", false)
            ->orden("t.id_acudiente", false);

        $acudientes = Acudiente::modelo()->listar($c);

        $this->plantilla = "reporte";
        $pdf = Sis::apl()->mpdf->crear();
        ob_start();
        $this->vista('reporte', ['acudientes' => $acudientes]);
        $texto = ob_get_clean();
        $pdf->writeHtml($texto);
        $pdf->Output("Acudientes-praxis.pdf", 'I');
    }

    public function accionCrear() {
        $this->validarIdentificacion();
        $modelo = new Acudiente();
        $modelo2 = new TipoDocumento();
        $modelo->tipo_doc_id = $this->tipoDocDef;
        /* Probancia 
        echo "<pre>";
        var_dump($this->_p['TipoDocumentos'], $this->_p['Documentos'],$this->_p['NombresDocumentos']);
        exit(); */
        if (isset($this->_p['Acudientes'])) {            
            Sis::apl()->bd->begin();
            $modelo->atributos = $this->_p['Acudientes'];
            $modelo->identificacion = trim($this->_p['Acudientes']['identificacion']);
            if ($modelo->guardar()) {
                $this->asociarDocumentos($modelo->id_acudiente, $modelo);
                $this->alertar('success','Guardado exitoso');                
                Sis::apl()->bd->commit();
                $this->redireccionar('inicio');
            }
        }
        $cdocs = new CCriterio();
        $cdocs->noEn("id_tipo_documento", [2,3]);
        $url = Sis::crearUrl(['Acudiente/crear']);
        $this->mostrarVista('crear', ['modelo' => $modelo,
            'modelo2' => $modelo2,
            'url' => $url,
            'url2' => 'vacio',
            'tiposIdentificaciones' => CHtml::modelolista(TipoIdentificacion::modelo()->listar($cdocs), "id_tipo_documento", "nombre"),
            'tiposDocumentos' => CHtml::modelolista(TipoDocumento::modelo()->listar(), "id_tipo", "nombre"),
        ]);
    }
    
    private function validarIdentificacion($id = null){
        if(isset($this->_p['validarIdentificacion'])){
            if($id === null){
                $criterio = [
                    'where' => "identificacion = '" . $this->_p['identificacion'] . "'"
                ];
            } else {
                $criterio = [
                    'where' => "id_acudiente <> $id AND identificacion = '" . $this->_p['identificacion'] . "'"
                ];
            }
            $acudiente = Acudiente::modelo()->primer($criterio);
            if($acudiente != null){
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
    
    public function asociarDocumentos($acu, $modelo) {
        if (isset($_FILES['Documentos']) && isset($this->_p['TiposDocumentos']) && isset($this->_p['NombresDocumentos'])) {
            foreach ($this->_p['TiposDocumentos'] as $k => $v) {
                $nomtipo = trim($this->_p['NombresDocumentos'][$k]) . '_acudiente_' . $modelo->identificacion;
                $files = CArchivoCargado::instanciarTodasPorNombre('Documentos');
                $rutaDestino = Sis::resolverRuta(Sis::crearCarpeta("!publico.documentos.acudientes.$acu"));
                if(!$files[$k]->guardar($rutaDestino, $nomtipo)){continue;} // La idea es que si no se guardo en el host
                // el documento no se generen registros en la bd
                $doc = $this->asociarDocumento($nomtipo, $k, $v, $files, $acu);
                $this->asociarAcudienteDocumento($acu, $doc);
            }
        }
    }

    public function asociarDocumento($nomtipo, $k, $v, $files, $acu){
        $doc = new Documento();
        $doc->titulo = $nomtipo;
        // Usar DS en vez de / (?)
        $doc->url = "acudientes/$acu/$nomtipo." . $files[$k]->getExtension();
        $doc->tipo_id = $v;
        $doc->guardar();                
        return $doc;
    }
    
    public function asociarAcudienteDocumento($acu, $doc){
        $acudoc = new AcudienteDocumento();
        $acudoc->acudiente_id = $acu;
        $acudoc->documento_id = $doc->id_documento;
        $acudoc->guardar();
    }

    /**
     * Esta función permite editar un registro existente
     * @param int $pk
     */
    public function accionEditar($pk) {
        $this->validarIdentificacion($pk);
        $modelo = $this->cargarModelo($pk);
        $modelo2 = new TipoDocumento();
        if (isset($this->_p['Acudientes'])) {
            $modelo->atributos = $this->_p['Acudientes'];
            $modelo->identificacion = trim($this->_p['Acudientes']['identificacion']);
            Sis::apl()->bd->begin();
            if ($modelo->guardar()) {
                $this->asociarDocumentos($modelo->id_acudiente, $modelo);
                $this->alertar('success', 'Modificación exitosa');                
                Sis::apl()->bd->commit();
                $this->redireccionar('inicio');
            }
        }
        $url = Sis::crearUrl(['Acudiente/editar', 'id' => $pk]);
        $url2 = Sis::crearUrl(['Acudiente/validarNombreDoc', 'id' => $pk]);
        $cdocs = new CCriterio();
        $cdocs->noEn("id_tipo_documento", [2,3]);
        $this->mostrarVista('editar', ['modelo' => $modelo,
            'modelo2' => $modelo2,
            'url'=>$url,
            'url2'=>$url2,
            'tiposIdentificaciones' => CHtml::modelolista(TipoIdentificacion::modelo()->listar($cdocs), "id_tipo_documento", "nombre"),
            'tiposDocumentos' => CHtml::modelolista(TipoDocumento::modelo()->listar(), "id_tipo", "nombre"),
        ]);
    }

    public function accionAjx(){
        if(!isset($this->_p['ajx'])){
            $this->redireccionar("inicio");            
        }
        
        if(isset($this->_p['remover-doc'])){
            $this->removerDoc();
        }
    }

    private function removerDoc(){
        $id = $this->_p['id'];
        $detalle = AcudienteDocumento::modelo()->porPk($id);
        $documento = $detalle->Documento;
        $rutaBase = Sis::resolverRuta("!publico.documentos");
        $ruta = $rutaBase . DS . str_replace('/', DS, $documento->url);
        $this->json([
            'error' => !(unlink($ruta) && $detalle->eliminar() && $documento->eliminar())
        ]);
    }
    
    /**
     * Esta función permite ver detalladamente un registro existente
     * @param int $pk
     */
    public function accionVer($pk) {
        $modelo = $this->cargarModelo($pk);
        $this->mostrarVista('ver', ['modelo' => $modelo,
        ]);
    }
    
    public function accionValidarNombreDoc() { // solo se comprueba en actualizar
        if (isset($this->_p['validarNombreDoc'])) {
            $nomdoc = $this->_p['nombre'];
            $criterio = new CCriterio();        
            // t seria la tabla deportista_documentos y listar
            $criterio->union("tbl_documentos", "d")
                ->donde("t.documento_id", "=", "d.id_documento")                  
                ->condicion("t.acudiente_id", $this->id_acudiente, "=")                   
                ->y("d.titulo", $nomdoc, "=");
            $modelo = AcudienteDocumento::modelo()->listar($criterio);           
            if (count($modelo) > 0) {
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
     * Esta función permite eliminar un registro existente
     * @param int $pk
     */
    /*public function accionEliminar($pk) {
        $modelo = $this->cargarModelo($pk);
        if ($modelo->eliminar()) {
            # lógica para borrado exitoso
        } else {
            # lógica para error al borrar
        }
        $this->redireccionar('inicio');
    }*/
    
    public function accionEliminarAcudienteDocumento(){
        if (isset($this->_p['idacudoc'])) {
            $idAcuDoc = $this->_p['idacudoc'];            
            $acuDoc = AcudienteDocumento::modelo()->porPk($idAcuDoc);
            $idDoc = $acuDoc->documento_id;
            $doc = Documento::modelo()->porPk($idDoc);
            $rutaDoc = Sis::resolverRuta("!publico") . "\\" . str_replace("/", "\\", $doc->url);
            /*echo "<pre>";
            var_dump($rutaDoc);
            exit();*/
            $bandera = 0;
            $bandera += unlink($rutaDoc) ? 1: 0; // eliminar documento del host
            $bandera += $acuDoc->eliminar() ? 1: 0; // eliminar documento de la tbl_acudientes_documentos
            if ($bandera == 2) {
                $doc->eliminar(); // eliminar documento de la tbl_documentos                
                $tipo = "success";
                $msj = "Se eliminó el Documento";
            }else{
                $tipo = "error";
                $msj = "No se pudo eliminar el Documento";
            }
            $this->json([
                "tipo" => $tipo,
                "msj" => $msj
            ]);
        }
    }
    
    public function accionCambiarEstado($pk) {
        $modelo = $this->cargarModelo($pk);
        /*if ($modelo->estado == 0) {
            $this->alertar('warning', 'El Acudiente ya se encuentra Inactivo');
            $this->redireccionar('inicio');
        }*/
        $da = DeportistaAcudiente::modelo()->listar([
            'where' => "acudiente_id=$pk",
        ]);
        if (count($da) > 0) {
            $this->alertar('error', 'No se puede Inactivar. Esta Persona es acudiente de un Deportista');
        } else {
            $modelo->estado = ($modelo->estado==1) ? 0: 1;
            if ($modelo->guardar()) {
                $this->alertar('success', 'Cambio de estado exitoso');
            }            
        }
        $this->redireccionar('inicio');
    }

    private function alertar($tipo, $msj) {
        Sis::Sesion()->flash("alerta", [
            'msg' => $msj,
            'tipo' => $tipo,
        ]);
    }

    /**
     * Esta función permite cargar un modelo usando su primary key
     * @param int $pk
     * @return Acudiente
     */
    private function cargarModelo($pk) {
        return Acudiente::modelo()->porPk($pk);
    }

}
