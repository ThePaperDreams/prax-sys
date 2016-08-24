<?php

/**
 * Este es el controlador Deportista, desde aquí se gestionan
 * todas las actividades que tengan que ver con Deportista
 * @author Jorge Alejandro Quiroz Serna <alejo.jko@gmail.com>
 * @version 1.0.0
 */
class CtrlDeportista extends CControlador {

    /**
     * Esta función muestra el inicio y una tabla para listar los datos
     */
    public function accionInicio() {
        $modelos = Deportista::modelo()->listar();
        $this->mostrarVista('inicio', ['modelos' => $modelos,
        ]);
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
            $modelo->foto = $this->asociarFoto($modelo->identificacion);
            if ($modelo->guardar()) {
                $dep = $modelo->id_deportista;
                $this->asociarAcudientes($dep);
                $this->asociarDocumentos($dep);
                $this->alertar('success', 'Registro Exitoso');
                $this->redireccionar('inicio');
            }
        }
        $url = Sis::crearUrl(['Deportista/crear']);
        $this->mostrarVista('crear', ['modelo' => $modelo,
            'modelo2' => $modelo2,
            'modelo3' => $modelo3,
            'url' => $url,
            'tiposIdentificaciones' => CHtml::modelolista(TipoIdentificacion::modelo()->listar(), "id_tipo_documento", "nombre"),
            'acudientes' => CHtml::modelolista(Acudiente::modelo()->listar(), "id_acudiente", "Datos"),
            'tiposDocumentos' => CHtml::modelolista(TipoDocumento::modelo()->listar(), "id_tipo", "nombre"),
            'estados' => CHtml::modelolista(EstadoDeportista::modelo()->listar(), "id_estado", "nombre"),
        ]);
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

    public function asociarDocumentos($dep) {
        if (isset($_FILES['Documentos']) && isset($this->_p['TiposDocumentos']) && isset($this->_p['NombresDocumentos'])) {
            foreach ($this->_p['TiposDocumentos'] as $k => $v) {
                $nomtipo = $this->_p['NombresDocumentos'][$k];
                $files = CArchivoCargado::instanciarTodasPorNombre('Documentos');
                $rutaDestino = Sis::resolverRuta(Sis::crearCarpeta("!publico.deportistas.$dep"));
                $files[$k]->guardar($rutaDestino, $nomtipo);
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
            $modelo->foto = $this->asociarFoto($modelo->identificacion);
            $modelo->id_deportista = $pk;
            if ($modelo->guardar()) {
                $this->asociarAcudientes($pk);
                $this->asociarDocumentos($pk);
                $this->alertar('success', 'Actualización Exitosa');
                $this->redireccionar('inicio');
            }
        }
        $url = Sis::crearUrl(['Deportista/editar', 'id' => $pk]);
        $this->mostrarVista('editar', ['modelo' => $modelo,
            'modelo2' => $modelo2,
            'modelo3' => $modelo3,
            'url' => $url,
            'tiposIdentificaciones' => CHtml::modelolista(TipoIdentificacion::modelo()->listar(), "id_tipo_documento", "nombre"),
            'acudientes' => CHtml::modelolista(Acudiente::modelo()->listar(), "id_acudiente", "Datos"),
            'tiposDocumentos' => CHtml::modelolista(TipoDocumento::modelo()->listar(), "id_tipo", "nombre"),
            'estados' => CHtml::modelolista(EstadoDeportista::modelo()->listar(), "id_estado", "nombre"),
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
            $this->json([
                "tipo" => $tipo,
                "msj" => $msj
            ]);
        }
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
        if ($modelo->estado_id == 2) {
            $this->alertar('warning', 'El Deportista ya se encuentra Inactivo');
            $this->redireccionar('inicio');
        }        
        $modelo->estado_id = ($modelo->estado_id != 2) ? 2 : 1;
        if ($modelo->guardar()) {
            $this->alertar('success', 'Cambio de estado exitoso');
        }
        $this->redireccionar('inicio');
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
        $nom = $this->_p['nom'];
        $modelo = $this->cargarModelo($dep);
        $modelo->foto = "";
        if ($modelo->guardar()) {
            $ruta = Sis::resolverRuta("!publico.imagenes.deportistas.fotos");
            $ruta .= DS . $nom;
            unlink($ruta);
            $path = Sis::resolverRuta("!publico.imagenes.deportistas.fotos.thumbs");
            $path .= DS . "tmb_" . $nom;
            unlink($path);            
        }
        $this->json([
            "tipo" => "success",
            "msj" => "Foto eliminada"
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
