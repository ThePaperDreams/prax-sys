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
        $modelo = new Deportista();
        $modelo2 = new Acudiente();
        $modelo3 = new TipoDocumento();
        if (isset($this->_p['Deportistas'])) {
            //echo "<pre>";
            //var_dump($this->_p['TiposDocumentos']);
            //exit();
            $modelo->atributos = $this->_p['Deportistas'];
            if ($modelo->guardar()) {
                $this->asociarAcudientes($modelo->id_deportista);
                $this->asociarDocumentos($modelo->id_deportista);
                $this->redireccionar('inicio');
            }
        }
        $this->mostrarVista('crear', ['modelo' => $modelo,
            'modelo2' => $modelo2,
            'modelo3' => $modelo3,
            'tiposIdentificaciones' => CHtml::modelolista(TipoIdentificacion::modelo()->listar(), "id_tipo_documento", "nombre"),
            'acudientes' => CHtml::modelolista(Acudiente::modelo()->listar(), "id_acudiente", "Datos"),
            'tiposDocumentos' => CHtml::modelolista(TipoDocumento::modelo()->listar(), "id_tipo", "nombre"),
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
            foreach ($this->_p['TiposDocumentos'] as $k => $v) {
                $tipodoc = new TipoDocumento();
                $nomtipo = $tipodoc->primer(["where" => "id_tipo=" . $v])->nombre;
                $files = CArchivoCargado::instanciarTodasPorNombre('Documentos');
                $rutaDestino = Sis::resolverRuta(Sis::crearCarpeta("!publico.deportistas.$dep"));
                $files[$k]->guardar($rutaDestino, $nomtipo);
                $doc = $this->asociarDocumento($nomtipo, $k, $v, $files);
                $this->asociarDeportistaDocumento($dep, $doc);
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
        $modelo = $this->cargarModelo($pk);
        $modelo2 = new Acudiente();
        $modelo3 = new TipoDocumento();
        if (isset($this->_p['Deportistas'])) {
            $modelo->atributos = $this->_p['Deportistas'];
            $modelo->id_deportista = $pk;
            if ($modelo->guardar()) {
                $this->asociarAcudientes($pk);
                $this->asociarDocumentos($pk);
                $this->redireccionar('inicio');
            }
        }
        $this->mostrarVista('editar', ['modelo' => $modelo,
            'modelo2' => $modelo2,
            'modelo3' => $modelo3,
            'tiposIdentificaciones' => CHtml::modelolista(TipoIdentificacion::modelo()->listar(), "id_tipo_documento", "nombre"),
            'acudientes' => CHtml::modelolista(Acudiente::modelo()->listar(), "id_acudiente", "Datos"),
            'tiposDocumentos' => CHtml::modelolista(TipoDocumento::modelo()->listar(), "id_tipo", "nombre"),
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

    /**
     * Esta función permite eliminar un registro existente
     * @param int $pk
     */
    public function accionEliminar($pk) {
        $modelo = $this->cargarModelo($pk);
        if ($modelo->eliminar()) {
            # lógica para borrado exitoso
        } else {
            # lógica para error al borrar
        }
        $this->redireccionar('inicio');
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
