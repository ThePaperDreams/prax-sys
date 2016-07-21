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
            $modelo->atributos = $this->_p['Deportistas'];
            if ($modelo->guardar()) {
                $this->asociarAcudientes($modelo);
                $this->asociarDocumentos($modelo);
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

    public function asociarAcudientes($modelo, $dep = '') {
        if (isset($this->_p['Acudientes'])) {
            $ultdep = ($dep === '') ? $modelo->primer(["order" => "id_deportista desc"])->id_deportista : $dep;
            foreach ($this->_p['Acudientes'] as $v) {
                $modelo3 = new DeportistaAcudiente();
                // obtener la ultimo deportista registrado
                $modelo3->id_deportista = $ultdep;
                $modelo3->id_acudiente = $v;
                $modelo3->guardar();
            }
        }
    }

    public function asociarDocumentos($modelo, $dep = '') {
        if (isset($_FILES['Documentos']) && isset($this->_p['TiposDocumentos'])) {
            $ultdep = ($dep === '') ? $modelo->primer(["order" => "id_deportista desc"])->id_deportista : $dep;
            foreach ($this->_p['TiposDocumentos'] as $k => $v) {
                $tipodoc = new TipoDocumento();
                $nomtipo = $tipodoc->primer(["where" => "id_tipo=" . $v])->nombre;
                $files = CArchivoCargado::instanciarTodasPorNombre('Documentos');
                $rutaDestino = Sis::resolverRuta(Sis::crearCarpeta("!publico.deportistas.$ultdep"));
                $files[$k]->guardar($rutaDestino, $nomtipo);
                $doc = new Documento();
                $doc->titulo = $nomtipo;
                $doc->url = "publico/deportistas/" . $ultdep . "/" . $nomtipo . "." . $files[$k]->getExtension();
                $doc->tipo_id = $v;
                $doc->guardar();
                $depdoc = new DeportistaDocumento();
                $depdoc->deportista_id = $ultdep;
                $depdoc->documento_id = $doc->primer(["order" => "id_documento desc"])->id_documento;
                $depdoc->guardar();
            }
        }
    }

    /**
     * Esta función permite editar un registro existente
     * @param int $pk
     */
    public function accionEditar($pk) {
        $modelo = $this->cargarModelo($pk);
//        var_dump($modelo);
//        exit();
        $modelo2 = new Acudiente();
        $modelo3 = new TipoDocumento();
        if (isset($this->_p['Deportistas'])) {
            $modelo->atributos = $this->_p['Deportistas'];
            $modelo->id_deportista = $pk;
            if ($modelo->guardar()) {
                $this->asociarAcudientes($modelo, $pk);                
                $this->asociarDocumentos($modelo, $pk);
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
            'estados' => CHtml::modelolista(EstadoDeportista::modelo()->listar(), "id_estado", "nombre"),
            'tiposIdentificaciones' => CHtml::modelolista(TipoIdentificacion::modelo()->listar(), "id_tipo_documento", "nombre"),
        ]);
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
