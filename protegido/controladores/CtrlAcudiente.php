<?php

/**
 * Este es el controlador Acudiente, desde aquí se gestionan
 * todas las actividades que tengan que ver con Acudiente
 * @author Jorge Alejandro Quiroz Serna <alejo.jko@gmail.com>
 * @version 1.0.0
 */
class CtrlAcudiente extends CControlador {

    /**
     * Esta función muestra el inicio y una tabla para listar los datos
     */
    public function accionInicio() {
        $modelos = Acudiente::modelo()->listar();
        $this->mostrarVista('inicio', ['modelos' => $modelos,
        ]);
    }

    public function accionCrear() {
        $modelo = new Acudiente();
        $modelo2 = new TipoDocumento();
        if (isset($this->_p['Acudientes'])) {            
            $modelo->atributos = $this->_p['Acudientes'];
            if ($modelo->guardar()) {
                $this->asociarDocumentos($modelo->id_acudiente);
                $this->redireccionar('inicio');
            }
        }
        $this->mostrarVista('crear', ['modelo' => $modelo,
            'modelo2' => $modelo2,
            'tiposIdentificaciones' => CHtml::modelolista(TipoIdentificacion::modelo()->listar(), "id_tipo_documento", "nombre"),
            'tiposDocumentos' => CHtml::modelolista(TipoDocumento::modelo()->listar(), "id_tipo", "nombre"),
        ]);
    }
    
    public function asociarDocumentos($acu) {
        if (isset($_FILES['Documentos']) && isset($this->_p['TiposDocumentos'])) {
            foreach ($this->_p['TiposDocumentos'] as $k => $v) {
                $tipodoc = new TipoDocumento();
                $nomtipo = $tipodoc->primer(["where" => "id_tipo=" . $v])->nombre;
                $files = CArchivoCargado::instanciarTodasPorNombre('Documentos');
                $rutaDestino = Sis::resolverRuta(Sis::crearCarpeta("!publico.acudientes.$acu"));
                $files[$k]->guardar($rutaDestino, $nomtipo);
                $doc = $this->asociarDocumento($nomtipo, $k, $v, $files);
                $this->asociarAcudienteDocumento($acu, $doc);
            }
        }
    }
    
    public function asociarDocumento($nomtipo, $k, $v, $files){
        $doc = new Documento();
        $doc->titulo = $nomtipo;
        $doc->url = $nomtipo . "." . $files[$k]->getExtension();
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
        $modelo = $this->cargarModelo($pk);
        $modelo2 = new TipoDocumento();
        if (isset($this->_p['Acudientes'])) {
            $modelo->atributos = $this->_p['Acudientes'];
            if ($modelo->guardar()) {
                $this->asociarDocumentos($modelo->id_acudiente);
                $this->redireccionar('inicio');
            }
        }
        $this->mostrarVista('editar', ['modelo' => $modelo,
            'modelo2' => $modelo2,
            'tiposIdentificaciones' => CHtml::modelolista(TipoIdentificacion::modelo()->listar(), "id_tipo_documento", "nombre"),
            'tiposDocumentos' => CHtml::modelolista(TipoDocumento::modelo()->listar(), "id_tipo", "nombre"),
        ]);
    }

    /**
     * Esta función permite ver detalladamente un registro existente
     * @param int $pk
     */
    public function accionVer($pk) {
        $modelo = $this->cargarModelo($pk);
        $modelo2 = new Documento();
        $this->mostrarVista('ver', ['modelo' => $modelo,
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
    
    public function accionEliminarAcudienteDocumento() {
        $ad = new AcudienteDocumento();
        $d = new Documento();
        $a = new Acudiente();
        if (isset($this->_p['idacudoc']) && isset($this->_p['iddoc']) && isset($this->_p['nomtipo']) && isset($this->_p['idacu'])) {
            $ad->id = $this->_p['idacudoc'];
            $d->id_documento = $this->_p['iddoc'];
            $d->url = $this->_p['nomtipo'];
            $a->id_acudiente = $this->_p['idacu'];
            if ($ad->eliminar()) {
                $this->accionEliminarDocumento($d, $a);
            } else {            
            }
        }
    } 
    
    public function accionEliminarDocumento($d, $a){
        if ($d->eliminar()) {
            $ruta = Sis::resolverRuta("!publico.acudientes.$a->id_acudiente" . "\\");
            $ruta .= $d->url;
            unlink($ruta);
        }
    }
    
    public function accionCambiarEstado($pk) {
        $modelo = $this->cargarModelo($pk);
        $modelo->estado = !$modelo->estado;
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
     * Esta función permite cargar un modelo usando su primary key
     * @param int $pk
     * @return Acudiente
     */
    private function cargarModelo($pk) {
        return Acudiente::modelo()->porPk($pk);
    }

}
