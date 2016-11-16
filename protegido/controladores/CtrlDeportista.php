<?php

/**
 * Este es el controlador Deportista, desde aquí se gestionan
 * todas las actividades que tengan que ver con Deportista
 * @author Jorge Alejandro Quiroz Serna <alejo.jko@gmail.com>
 * @version 1.0.0
 */
class CtrlDeportista extends CControlador {
    public $ayuda;
    public $ayudaTitulo;

    private $tipoDocDef = 3;
    /**
     * Esta función muestra el inicio y una tabla para listar los datos
     */
    public function accionInicio() {
        $this->mostrarVista('inicio', [
            'estados' => CHtml::modelolista(EstadoDeportista::modelo()->listar(), "id_estado", "nombre"),
        ]);
    }

    public function accionVerSeguimientos($id){
        $deportista = Deportista::modelo()->porPk($id);
        $ficha = $deportista->getFicha();
        $positivos = $ficha->seguimientosPositivos;
        $negativos = $ficha->seguimientosNegativos;

        $this->vista('verSeguimientos', [
            'deportista' => $deportista,
            'positivos' => $positivos,
            'negativos' => $negativos,
        ]);
    }

    public function accionImprimirSeguimientos($id){
        $deportista = Deportista::modelo()->porPk($id);
        $ficha = $deportista->getFicha();
        $positivos = $ficha->seguimientosPositivos;
        $negativos = $ficha->seguimientosNegativos;

        $this->tituloPagina = "Reporte de seguimientos - praxis";

        $this->plantilla = "reporte";
        $pdf = Sis::apl()->mpdf->crear();
        ob_start();
        $this->vista('imprimirSeguimientos', [
            'deportista' => $deportista,
            'positivos' => $positivos,
            'negativos' => $negativos,
        ]);

        $texto = ob_get_clean();
        $pdf->writeHtml($texto);
        $pdf->Output("Deportistas-praxis.pdf", 'I');

    }

    public function accionImprimirFicha($id){
        $deportista = Deportista::modelo()->porPk($id);
        $ficha = $deportista->getFicha();

        $this->tituloPagina = "$deportista->nombreCompleto";

        $this->plantilla = "reporte";
        $pdf = Sis::apl()->mpdf->crear();
        ob_start();
        $this->vista('imprimirFicha', [
            'deportista' => $deportista,
            'ficha' => $ficha,
        ]);        
        $texto = ob_get_clean();
        // echo $texto;
        // exit();
        $pdf->writeHtml($texto);
        $pdf->Output("Deportistas-praxis.pdf", 'I');
    }


    public function accionReporte(){
        if(!isset($this->_p['modelo'])){
            $this->redireccionar('inicio');
        }

        $this->tituloPagina = "Deportistas - praxis";
        $campos = $this->_p['modelo'];
        foreach($campos AS $k=>$v){ $campos[$k] = $v == ''? null : $v; }

        $c = new CCriterio();
        $concat = "CONCAT_WS(' ', t.nombre1,t.nombre2,t.apellido1,t.apellido2)";
        $c->unionIzq("tbl_matriculas", "m")
            ->donde("t.id_deportista", "=", "m.deportista_id AND m.estado = 1")
            ->condicion($concat, $campos['_nombreCompleto'], "LIKE")
            ->y("t.identificacion", $campos['doc'], "LIKE")
            ->y("fecha_nacimiento", $campos['fecha_nacimiento'], "LIKE")
            ->y("t.estado_id", $campos['estado_id'], "LIKE")
            ->orden("t.estado_id = 1", false)
            ->orden("t.id_deportista", false);

        if($campos['matricula'] == 1){
            $c->noEsVacio("m.id_matricula");
        } else if($campos['matricula'] == 2){
            $c->esVacio("m.id_matricula");
        }

        $deportistas = Deportista::modelo()->listar($c);

        $this->plantilla = "reporte";
        $pdf = Sis::apl()->mpdf->crear();
        ob_start();
        $this->vista('reporte', ['deportistas' => $deportistas]);
        $texto = ob_get_clean();
        $pdf->writeHtml($texto);
        $pdf->Output("Deportistas-praxis.pdf", 'I');
    }

    public function accionReporteListaEspera(){
         if(!isset($this->_p['modelo'])){
            $this->redireccionar('inicio');
        }

        $this->tituloPagina = "Deportistas en lista de espera - praxis";
        $campos = $this->_p['modelo'];
        foreach($campos AS $k=>$v){ $campos[$k] = $v == ''? null : $v; }

        $c = new CCriterio();
        $concat = "CONCAT_WS(' ', t.nombre1,t.nombre2,t.apellido1,t.apellido2)";
        $c->condicion($concat, $campos['_nombreCompleto'], "LIKE")
            ->y("t.identificacion", $campos['identificacion'], "LIKE")
            ->y("t.estado_id", "4", "LIKE")
            ->orden("t.id_deportista", false);

        $deportistas = Deportista::modelo()->listar($c);

        $this->plantilla = "reporte";
        $pdf = Sis::apl()->mpdf->crear();
        ob_start();
        $this->vista('reporte', ['deportistas' => $deportistas]);
        $texto = ob_get_clean();
        $pdf->writeHtml($texto);
        $pdf->Output("Deportistas-lista-de-espera-praxis.pdf", 'I');   
    }

    /**
     * Esta función permite crear un nuevo registro
     */
    public function accionCrear() {
        $this->validarIdentificacion();
        $modelo = new Deportista();
        $modelo2 = new Acudiente();
        $modelo3 = new TipoDocumento();
        if (isset($this->_p['Deportistas'])) {
            $modelo->atributos = $this->_p['Deportistas'];
            $modelo->identificacion = trim($this->_p['Deportistas']['identificacion']);
            if ($this->_p['cambio-foto'] === "1") {
                $modelo->foto = $this->asociarFoto($modelo->identificacion);                                
            }
            Sis::apl()->bd->begin();
            if ($modelo->guardar()) {
                $dep = $modelo->id_deportista;
                $this->asociarAcudientes($dep);
                $this->asociarDocumentos($dep, $modelo);
                $this->alertar('success', 'Registro Exitoso');
                Sis::apl()->bd->commit();
                $this->redireccionar('inicio');
            }
            Sis::apl()->rollback();
        }
        $formularioAcudiente = $this->getFormAcudientes();
        # seteamos un tipo de documento por defecto al deportista
        $modelo->tipo_documento_id = $this->tipoDocDef;
        $url = Sis::crearUrl(['Deportista/crear']);
        $this->mostrarVista('crear', ['modelo' => $modelo,
            'formularioAcudiente' => $formularioAcudiente,
            'modelo2' => $modelo2,
            'modelo3' => $modelo3,
            'url' => $url,
            'url2' => 'vacio',
            'tiposIdentificaciones' => CHtml::modelolista(TipoIdentificacion::modelo()->listar(), "id_tipo_documento", "nombre"),
            'acudientes' => CHtml::modelolista(Acudiente::modelo()->listar(['where' => 'estado=1']), "id_acudiente", "Datos"),
            'tiposDocumentos' => CHtml::modelolista(TipoDocumento::modelo()->listar(), "id_tipo", "nombre"),
            'estados' => CHtml::modelolista(EstadoDeportista::modelo()->listar(), "id_estado", "nombre"),
            'formularioAcudiente' => $formularioAcudiente,
        ]);
    }

    public function accionAjax(){
        if(!isset($this->_p['ajx_request'])){ $this->redireccionar("inicio"); }
        if($this->_p['tipo'] == 'guardar-acudiente'){
            $this->guardarAcudiente();
        }
        Sis::fin();
    }

    private function guardarAcudiente(){
        $acudiente = new Acudiente();

        $acudiente->atributos = $this->_p['modelo'];
        $error = !$acudiente->guardar();
        // $error = false;
        $this->json([
            'error' => $error,
            'acudiente' => [
                'nombre' => $acudiente->identificacion . " ($acudiente->nombreCompleto)",
                'id' => $acudiente->id_acudiente,
            ],
            'msg' => $error? "Ocurrió un error al guardar el acudiente" : "Se guardó correctamente el acudiente"
        ]);
    }

    private function getFormAcudientes(){
        $ti = TipoIdentificacion::modelo()->listar();
        $tiposIdentificaciones = CHtml::modeloLista($ti, 'id_tipo_documento', 'nombre');
        $modelo = new Acudiente();
        $formularioAcudiente = $this->vistaP('_formulario_acudiente', ['modelo' => $modelo, 'tiposIdentificaciones' => $tiposIdentificaciones]);
        return $formularioAcudiente;
    }

    public function asociarAcudientes($dep) {
        if (isset($this->_p['Acudient'])) {
            foreach ($this->_p['Acudient'] as $v) {
                $modelo4 = new DeportistaAcudiente();
                $modelo4->deportista_id = $dep;
                $modelo4->acudiente_id = $v;
                $modelo4->guardar();
            }
        }
    }

    public function asociarDocumentos($dep, $modelo) {
        if (isset($_FILES['Documentos']) && isset($this->_p['TiposDocumentos']) && isset($this->_p['NombresDocumentos'])) {
            foreach ($this->_p['TiposDocumentos'] as $k => $v) {
                $nomtipo = trim($this->_p['NombresDocumentos'][$k]) . '_deportista_' . $modelo->identificacion;
                $files = CArchivoCargado::instanciarTodasPorNombre('Documentos');
                $rutaDestino = Sis::resolverRuta(Sis::crearCarpeta("!publico.documentos.deportistas.$dep"));
                if(!$files[$k]->guardar($rutaDestino, $nomtipo)){continue;}
                $doc = $this->asociarDocumento($nomtipo, $k, $v, $files, $dep);
                $this->asociarDeportistaDocumento($dep, $doc);
            }
        }
    }

    public function asociarDocumento($nomtipo, $k, $v, $files, $dep) {
        $doc = new Documento();
        $doc->titulo = $nomtipo;
        // Usar DS en vez de / (?)
        $doc->url = "deportistas/$dep/$nomtipo." . $files[$k]->getExtension();
        $doc->tipo_id = $v;
        $doc->guardar();                
        return $doc;
    }

    public function asociarDeportistaDocumento($dep, $doc) {
        $acudoc = new DeportistaDocumento();
        $acudoc->deportista_id = $dep;
        $acudoc->documento_id = $doc->id_documento;
        $acudoc->guardar();
        /*$acudoc = new DeportistaDocumento();
        $acudoc->deportista_id = $dep;
        $acudoc->documento_id = $doc->id_documento;
        $acudoc->guardar();*/
    }

    /**
     * Esta función permite editar un registro existente
     * @param int $pk
     */
    public function accionEditar($pk) {
        $this->validarIdentificacion($pk);
        $modelo = $this->cargarModelo($pk);
        $modelo2 = new Acudiente();
        $modelo3 = new TipoDocumento();
        if (isset($this->_p['Deportistas'])) {
            $modelo->atributos = $this->_p['Deportistas'];
            $modelo->identificacion = trim($this->_p['Deportistas']['identificacion']);
            $modelo->id_deportista = $pk;
            if ($this->_p['cambio-foto'] === "1") {
                $this->eliminarFoto($modelo->foto);
                $modelo->foto = $this->asociarFoto($modelo->identificacion);                                
            }
            if ($modelo->guardar()) {
                $this->asociarAcudientes($pk);
                $this->asociarDocumentos($pk, $modelo);
                $this->alertar('success', 'Actualización Exitosa');
                $this->redireccionar('inicio');
            }
        }
        $url = Sis::crearUrl(['Deportista/editar', 'id' => $pk]);
        $url2 = Sis::crearUrl(['Deportista/validarNombreDoc', 'id' => $pk]);
        $formularioAcudiente = $this->getFormAcudientes();

        $this->mostrarVista('editar', ['modelo' => $modelo,
            'formularioAcudiente' => $formularioAcudiente,
            'modelo2' => $modelo2,
            'modelo3' => $modelo3,
            'url' => $url,
            'url2' => $url2,
            'tiposIdentificaciones' => CHtml::modelolista(TipoIdentificacion::modelo()->listar(), "id_tipo_documento", "nombre"),
                        'acudientes' => CHtml::modelolista(Acudiente::modelo()->listar(['where' => 'estado=1']), "id_acudiente", "Datos"),
            'tiposDocumentos' => CHtml::modelolista(TipoDocumento::modelo()->listar(), "id_tipo", "nombre"),
            'estados' => CHtml::modelolista(EstadoDeportista::modelo()->listar(), "id_estado", "nombre"),
        ]);
    }
    
    public function accionValidarNombreDoc() { // solo se comprueba en actualizar
        if (isset($this->_p['validarNombreDoc'])) {
            $nomdoc = $this->_p['nombre'];
            $criterio = new CCriterio();        
            // t seria la tabla deportista_documentos y listar
            $criterio->union("tbl_documentos", "d")
                ->donde("t.documento_id", "=", "d.id_documento")                  
                ->condicion("t.deportista_id", $this->id_deportista, "=")                   
                ->y("d.titulo", $nomdoc, "=");
            $modelo = DeportistaDocumento::modelo()->listar($criterio);           
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
     * Esta función permite ver detalladamente un registro existente
     * @param int $pk
     */
    public function accionVer($pk) {
        $modelo = $this->cargarModelo($pk);
        $this->mostrarVista('ver', ['modelo' => $modelo,
        ]);
    }

    public function accionEliminarDeportistaDocumento() {
        if (isset($this->_p['iddepdoc'])) {
            $idDepDoc = $this->_p['iddepdoc'];            
            $depDoc = DeportistaDocumento::modelo()->porPk($idDepDoc);
            $idDoc = $depDoc->documento_id;
            $doc = Documento::modelo()->porPk($idDoc);
            $rutaDoc = Sis::resolverRuta("!publico") . "\\" . str_replace("/", "\\", $doc->url);
            /*echo "<pre>";
            var_dump($rutaDoc);
            exit();*/
            $bandera = 0;
            $bandera += unlink($rutaDoc) ? 1: 0; // eliminar documento del host
            $bandera += $depDoc->eliminar() ? 1: 0; // eliminar documento de la tbl_acudientes_documentos
            if ($bandera == 2) {
                $doc->eliminar(); // eliminar documento de la tbl_documentos                
                $tipo = "success";
                $msj = "Se eliminó el Documento";
            }else{
                $tipo = "error";
                $msj = "No se pudo eliminar el Documento";
            }
            $this->json(["tipo" => $tipo,"msj" => $msj]);
        }
    }
    
    public function accionReporteDeportista(){
        $criterios = new CCriterio();
        $concat = "CONCAT_WS(' ', t.nombre1,t.nombre2,t.apellido1,t.apellido2)";

        if(isset($this->_p['btn-vista'])){
            $this->limpiarPost($this->_p);
            var_dump($this->p);exit();
            $criterios->unionIzq("tbl_matriculas", "m")
                ->donde("t.id_deportista", "=", "m.deportista_id")
                ->condicion($concat, $this->_p['deportista'], 'LIKE')
                ->y("m.categoria_id", $this->_p['categoria'], "=")
                ->y("t.identificacion", $this->_p['identificacion'], 'LIKE')
                ->y("t.estado_id", $this->_p['estado'], '=')
                ->orden("t.estado_id", "asc");
        }
        $this->vista('reporteDeportista', [
            'criterios' => $criterios,
            'categorias' => CHtml::modelolista(Categoria::modelo()->listar(), "id_categoria", "nombre"),
            'estados' => CHtml::modelolista(EstadoDeportista::modelo()->listar(), "id_estado", "nombre"),
            'identificacion' => isset($this->_p['identificacion'])? $this->_p['identificacion'] : null,
            'nombre' => isset($this->_p['nombre'])? $this->_p['nombre'] : null,
            'categoria' => isset($this->_p['categoria'])? $this->_p['categoria'] : null,
            'estado' => isset($this->_p['estado'])? $this->_p['estado'] : null,
        ]);
    }
    
    private function limpiarPost(&$post){
        foreach($post AS $k=>$v){ if($v == ''){ $post[$k] = null; } }
    }
    
    public function accionGenerarReporte() {
        $deportistas = Deportista::modelo()->listar([
            'where' => 'estado_id=1',
        ]);        
        $pdf = Sis::apl()->mpdf->crear();
        $texto = $this->vistaP('generarReporte', ['deportistas' => $deportistas]);
        $pdf->writeHtml($texto);
        $pdf->Output("deportistas.pdf", 'I');
    }

    public function accionEliminarDocumento($d, $a) {
        if ($d->eliminar()) {
            $ruta = Sis::resolverRuta("!publico.deportistas.$a->id_deportista" . "\\");
            $ruta .= $d->url;
            unlink($ruta);
        }
    }

    public function accionEliminarAcudiente() {
        $da = new DeportistaAcudiente();
        if (isset($this->_p['iddepacu'])) {
            $da->id = $this->_p['iddepacu'];
            if ($da->eliminar()) {                
                $tipo = "success";
                $msj = "Se eliminó el Acudiente";
            }else{
                $tipo = "error";
                $msj = "No se pudo eliminar el Acudiente";
            }
            $this->json([
                "tipo" => $tipo,
                "msj" => $msj
            ]);
        }
    }

    private function alertar($tipo, $msj) {
        Sis::Sesion()->flash("alerta", [
            'msg' => $msj,
            'tipo' => $tipo,
        ]);
    }

    public function accionCambiarEstado($pk) {
        $modelo = $this->cargarModelo($pk);        
        $cr = new CCriterio();
        $cr->condicion("t.deportista_id", $pk, "=")
           ->y("t.estado", 1, "=");
        $prestamo = PrestamoDeportista::modelo()->listar($cr);
        
        if(count($prestamo) > 0){
            $this->alertar('error', 'No se puede Inactivar. El Deportista se encuentra en Préstamo');
            $this->redireccionar('inicio');
        }

        # si no activo o inactivo y no hay estado anterior lo activamos o inactivamos según convenga
        if(($modelo->estado_id == 1 || $modelo->estado_id == 2) && $modelo->estado_anterior == null){
            $modelo->estado_id = ($modelo->estado_id == 1)? 2 : 1;
        } else if($modelo->estado_anterior !== null){            
        # si hay estado anterior definimos el estado anterior
            $modelo->estado_id = $modelo->estado_anterior;
            $modelo->estado_anterior = null;
        }else {            
        # ni activo ni inactivo y no hay estado anterior inactivamos y guardamos el estado anterior
            $modelo->estado_anterior = $modelo->estado_id;
            $modelo->estado_id = 2;
        }

        if ($modelo->guardar()) {
            $this->alertar('success', 'Cambio de estado exitoso');
        }
        $this->redireccionar('inicio');
    }

    private function eliminarFoto($foto){
        $bandera = 0;
        if(is_null($foto) !== true && $foto !== ""){ // contiene foto
            $ruta = Sis::resolverRuta("!publico.imagenes.deportistas.fotos");
            $ruta .= DS . $foto;
            $bandera += unlink($ruta) ? 1 : 0;
            $path = Sis::resolverRuta("!publico.imagenes.deportistas.fotos.thumbs");
            $path .= DS . "tmb_" . $foto;
            $bandera += unlink($path) ? 1 : 0;            
        }
        return $bandera;
    }
    
    public function asociarFoto($dep) {
        if ($_FILES['Deportistas']['error'] !== UPLOAD_ERR_OK) {
            $files = CArchivoCargado::instanciarModelo('Deportistas', 'foto');
            $rutaDestino = Sis::resolverRuta(Sis::crearCarpeta("!publico.imagenes.deportistas.fotos"));
            $rutaThumbs = Sis::resolverRuta(Sis::crearCarpeta("!publico.imagenes.deportistas.fotos.thumbs"));
            $nom = "Foto_$dep";
            if ($files->guardar($rutaDestino, $nom)) {
                $files->thumbnail($rutaThumbs, [
                    'tamanio' => '400',
                    'tipo' => strtolower($files->getExtension()),
                ]);
            }else{
                return "";                
            }
            $nom .= "." . $files->getExtension();
            return $nom;
        } else {
            return "";
        }
    }

    /**
     * Esta función permite eliminar un registro existente
     * @param int $pk
     */
    /*public function accionEliminar($pk) {
        $modelo = $this->cargarModelo($pk);
        if ($modelo->eliminar()) {
            
        } else {
            # lógica para error al borrar
        }
        $this->redireccionar('inicio');
    }*/

    public function accionEliminarFoto() {
        $dep = $this->_p['dep'];
        //$nom = $this->_p['nom'];
        $modelo = $this->cargarModelo($dep);
        $resp = $this->eliminarFoto($modelo->foto);
        if ($resp === 2) {
            $modelo->foto = "";
            if($modelo->guardar()){
                $tipo = "success";
                $msj = "La Foto ha sido eliminada";
            }
        }else{
            $tipo = "error";
            $msj = "La Foto no se pudo eliminar";
        }
        $this->json([
            "tipo" => $tipo,
            "msj" => $msj
        ]);
    }

    private function validarIdentificacion($id = null) {
        if (isset($this->_p['validarIdentificacion'])) {
            if ($id === null) {
                $criterio = [
                    'where' => "identificacion = '" . $this->_p['identificacion'] . "'"
                ];
            } else {
                $criterio = [
                    'where' => "id_deportista <> $id AND identificacion = '" . $this->_p['identificacion'] . "'"
                ];
            }
            $deportista = Deportista::modelo()->primer($criterio);
            if ($deportista != null) {
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

    public function accionFichaTecnica($pk) {
        $deportista = Deportista::modelo()->porPk($pk);

        $ficha = FichaTecnica::modelo()->primer(['where' => "deportista_id='$pk'"]);
        if ($ficha == null) {
            $ficha = new FichaTecnica();
            $ficha->deportista_id = $pk;
            $ficha->entrenador_id = 1;
        }
        
        
        if(isset($this->_p['ajx'])){
            $ficha->atributos = $this->_p['ficha'];
            $this->json([
                'error' => !$ficha->guardar(),
            ]);
            Sis::fin();
        }

        $this->vista('fichaTecnca', [
            'deportista' => $deportista,
            'ficha' => $ficha,
            'piernas' => [
                        'Izquierda',
                        'Derecha',
                        'Ambas'
                    ],
            'gruposS' => [
                        'O-' => 'O-',
                        'O+' => 'O+',
                        'A-' => 'A-',
                        'A+' => 'A+',
                        'B-' => 'B-',
                        'B+' => 'B+',
                        'AB-' => 'AB-',
                        'AB+' => 'AB+',
                    ],
        ]);
    }
    
    public function accionSeguimiento($pk){
        $deportista = Deportista::modelo()->porPk($pk);
        $ficha = $deportista->getFicha();
        $seguimiento = new Seguimiento();
        
        if(isset($this->_p['ajx_snd'])){
            $this->guardarSeguimiento($ficha, $deportista);
        }
        
        $this->vista("registrarSeguimiento", [
            'deportista' => $deportista,
            'modelo' => $seguimiento,
            'ficha' => $ficha,
            'positivos' => $ficha->seguimientosPositivos,
            'negativos' => $ficha->seguimientosNegativos,
        ]);
    }
    
    /**
     * 
     * @param FichaTecnica $ficha
     * @param Deportista $deportista
     */
    private function guardarSeguimiento($ficha, $deportista){
        $seguimiento = new Seguimiento();
        if($ficha->id_ficha_tecnica == null){
            $ficha->entrenador_id = Sis::apl()->usuario->getID();
            $ficha->guardar();
        }
        $seguimiento->ficha_tecnica_id = $ficha->id_ficha_tecnica;
        $seguimiento->evaluacion = $this->_p['evaluacion'];
        $seguimiento->descripcion = $this->_p['descripcion'];
        $seguimiento->tipo_seguimiento = $this->_p['tipo'];
        
        $this->json([
            'error' => !$seguimiento->guardar(),            
            'ficha' => $ficha->id_ficha_tecnica,
            'fecha' => $seguimiento->fecha,
        ]);
        Sis::fin();
    }

    public function accionVerListaEspera() {
        $this->vista('verListaEspera');
    }

    /**
     * Esta función permite cargar un modelo usando su primary key
     * @param int $pk
     * @return Deportista
     */
    private function cargarModelo($pk) {
        return Deportista::modelo()->porPk($pk);
    }

}
