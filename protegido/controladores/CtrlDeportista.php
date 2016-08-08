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
            /* echo "<pre>";
              var_dump($_FILES['Deportistas']);
              if (!empty($_FILES['Deportistas'])) {
              echo "Hola Mundo!";
              }
              exit(); *//*
              foreach ($_FILES['Deportistas'] as $k => $v){
              var_dump($k);
              var_dump($v);
              }
              echo "<br>";
              var_dump(CArchivoCargado::instanciarModelo('Deportistas', 'foto'));
              exit(); */
            $modelo->atributos = $this->_p['Deportistas'];
            $modelo->foto = $this->asociarFoto($modelo->identificacion);
            if ($modelo->guardar()) {
                $dep = $this->id_deportista;
                $this->asociarAcudientes($dep);
                $this->asociarDocumentos($dep);
                $this->alertar('success','Registro Exitoso');
                $this->redireccionar('inicio');
            }
        }
        $url = Sis::crearUrl(['Deportista/crear']);
        $this->mostrarVista('crear', ['modelo' => $modelo,
            'modelo2' => $modelo2,
            'modelo3' => $modelo3,
            'url'=>$url,
            'tiposIdentificaciones' => CHtml::modelolista(TipoIdentificacion::modelo()->listar(), "id_tipo_documento", "nombre"),
            'acudientes' => CHtml::modelolista(Acudiente::modelo()->listar(), "id_acudiente", "Datos"),
            'tiposDocumentos' => CHtml::modelolista(TipoDocumento::modelo()->listar(), "id_tipo", "nombre"),
            'estados' => CHtml::modelolista(EstadoDeportista::modelo()->listar(), "id_estado", "nombre"),
        ]);
    }

    public function asociarAcudientes($dep) {
        if (isset($this->_p['Acudientes'])) {
            foreach ($this->_p['Acudientes'] as $v) {
                if ($v) {
                    $modelo4 = new DeportistaAcudiente();
                    $modelo4->deportista_id = $dep;
                    $modelo4->acudiente_id = $v;
                    $modelo4->guardar();
                }
            }
        }
    }

    public function asociarDocumentos($dep) {
        if (isset($_FILES['Documentos']) && isset($this->_p['TiposDocumentos'])) {
            foreach ($_FILES['Documentos']['name'] as $k => $v) {
                if (empty($v)) {
                    foreach ($_FILES['Documentos'] as $y => $x) {
                        unset($_FILES['Documentos'][$y][$k]);
                    }
                }
            }
            foreach ($this->_p['TiposDocumentos'] as $k => $v) {
                $tipodoc = new TipoDocumento();
                $nomtipo = $tipodoc->primer(["where" => "id_tipo=" . $v])->nombre;
                $files = CArchivoCargado::instanciarTodasPorNombre('Documentos');
                $rutaDestino = Sis::resolverRuta(Sis::crearCarpeta("!publico.deportistas.$dep"));
                if (isset($files[$k])) {
                    $files[$k]->guardar($rutaDestino, $nomtipo);
                    $doc = $this->asociarDocumento($nomtipo, $k, $v, $files);
                    $this->asociarDeportistaDocumento($dep, $doc);
                }
            }
        }
    }

    public function asociarDocumento($nomtipo, $k, $v, $files) {
        $doc = new Documento();
        $doc->titulo = $nomtipo;
        $doc->url = $nomtipo . "." . $files[$k]->getExtension();
        $doc->tipo_id = $v;
        $doc->guardar();
        return $doc;
    }

    public function asociarDeportistaDocumento($dep, $doc) {
        $acudoc = new DeportistaDocumento();
        $acudoc->deportista_id = $dep;
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
        $modelo2 = new Acudiente();
        $modelo3 = new TipoDocumento();
        if (isset($this->_p['Deportistas'])) {
            $modelo->atributos = $this->_p['Deportistas'];
            $modelo->foto = $this->asociarFoto($modelo->identificacion);
            $modelo->id_deportista = $pk;
            if ($modelo->guardar()) {
                $this->asociarAcudientes($pk);
                $this->asociarDocumentos($pk);
                $this->alertar('success','Actualización Exitosa');
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
            'tiposIdentificaciones' => CHtml::modelolista(TipoIdentificacion::modelo()->listar(), "id_tipo_documento", "nombre"),
        ]);
    }

    public function accionEliminarDeportistaDocumento() {
        $ad = new DeportistaDocumento();
        $d = new Documento();
        $a = new Deportista();
        if (isset($this->_p['iddepdoc']) && isset($this->_p['iddoc']) && isset($this->_p['nomtipo']) && isset($this->_p['iddep'])) {
            $ad->id = $this->_p['iddepdoc'];
            $d->id_documento = $this->_p['iddoc'];
            $d->url = $this->_p['nomtipo'];
            $a->id_deportista = $this->_p['iddep'];
            if ($ad->eliminar()) {
                $this->accionEliminarDocumento($d, $a);
            } else {
                
            }
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
                
            }
        }
    }

    public function accionCambiarEstado($pk) {
        $modelo = $this->cargarModelo($pk);
        $modelo->estado_id = ($modelo->estado_id != 2) ? 2 : 1;
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

    public function asociarFoto($dep) {
        if (empty($_FILES['Deportistas']['name']['foto']) === false) {
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
    public function accionEliminar($pk) {
        $modelo = $this->cargarModelo($pk);
        if ($modelo->eliminar()) {            
        } else {            
            # lógica para error al borrar
        }
        $this->redireccionar('inicio');
    }

    public function accionEliminarFoto() {
        $dep = $this->_p['dep'];
        $nom = $this->_p['nom'];
        $modelo = $this->cargarModelo($dep);
        $modelo->foto = null;
        if ($modelo->guardar()) {
            $ruta = Sis::resolverRuta("!publico.imagenes.deportistas.fotos");
            $ruta .= DS . $nom;
            unlink($ruta);
            unlink($ruta);
            $path = Sis::resolverRuta("!publico.imagenes.deportistas.fotos.thumbs");
            $path .= DS . "tmb_" . $nom;
            unlink($path);
        }
    }
    
    private function validarIdentificacion($id = null){
        if(isset($this->_p['validarIdentificacion'])){
            if($id === null){
                $criterio = [
                    'where' => "identificacion = '" . $this->_p['identificacion'] . "'"
                ];
            } else {
                $criterio = [
                    'where' => "id_deportista <> $id AND identificacion = '" . $this->_p['identificacion'] . "'"
                ];
            }
            $deportista = Deportista::modelo()->primer($criterio);
            if($deportista != null){
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

    public function accionFichaTecnica($pk){
        $deportista = Deportista::modelo()->porPk($pk);
        
        $ficha = FichaTecnica::modelo()->primer(['where' => "deportista_id='$pk'"]);
        if($ficha == null){
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
        
        $this->vista('fichaTecnca',[
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
    
    public function accionVerListaEspera(){
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
