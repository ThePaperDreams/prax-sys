<?php
/**
 * Este es el controlador Torneo, desde aquí se gestionan
 * todas las actividades que tengan que ver con Torneo
 * @author Jorge Alejandro Quiroz Serna <alejo.jko@gmail.com>
 * @version 1.0.0
 */
class CtrlTorneo extends CControlador{
    
    /**
     * Esta función muestra el inicio y una tabla para listar los datos
     */
    public function accionInicio(){
        $modelos = Torneo::modelo()->listar();
        $this->mostrarVista('inicio', ['modelos' => $modelos,
            
            ]);
    }
    
    public function accionGestionarEquipos(){
        $categorias = Categoria::modelo()->listar([
            'where' => 'estado = 1'
        ]);
        $usuarios = Usuario::modelo()->listar();
        $this->vista('gestionarEquipos', [
            'categorias' => CHtml::modeloLista($categorias, "id_categoria", "nombre"),
            'usuarios' => CHtml::modeloLista($usuarios, "id_usuario", "nombres"),            
        ]);
    }
    
    public function accionAjx(){
        if(!isset($this->_p['ajx'])){ Sis::fin(); }
        $id = $this->_p['id'];
        $categoria = Categoria::modelo()->porPk($id);
        $deportistas =  $categoria->getDeportistasMatriculados();
        $html = '';
        foreach($deportistas AS $deportista){
            $html .= $this->vistaP('_itemDeportista', ['deportista' => $deportista]);
        }
        $this->json([
            'html' => $html,
        ]);
    }
    
    /**
     * Esta función permite crear un nuevo registro
     */
    public function accionCrear(){
        $modelo = new Torneo();
        if(isset($this->_p['Torneos'])){
            $modelo->atributos = $this->_p['Torneos'];
            $this->asociarFoto($modelo); 
            
            if($modelo->guardar()){
                # lógica para guardado exitoso
                $this->redireccionar('inicio');
            }
        }
        $this->mostrarVista('crear', ['modelo' => $modelo,
            ]);
    }
    
    /**
     * Esta función permite editar un registro existente
     * @param int $pk
     */
    public function accionEditar($pk){
        $modelo = $this->cargarModelo($pk);
        if(isset($this->_p['Torneos'])){
            
            $modelo->atributos = $this->_p['Torneos'];
            $this->asociarFoto($modelo); 
            
            if($modelo->guardar()){
                # lógica para guardado exitoso
                $this->redireccionar('inicio');
            }
        }
        $this->mostrarVista('editar', ['modelo' => $modelo,
            ]);
    }
    
    public function accionGenerarReporte() {
        $torneos = Torneo::modelo()->listar();
        
        $pdf = Sis::apl()->mpdf->crear();
        $texto = $this->vistaP('pdfTorneos', ['torneos' => $torneos]);
        $pdf->writeHtml($texto);
        $pdf->Output("Torneos.pdf", 'I');
    }
    
    /**
     * Esta función permite ver detalladamente un registro existente
     * @param int $pk
     */
    public function accionVer($pk){
        $modelo = $this->cargarModelo($pk);
        $this->mostrarVista('ver', ['modelo' => $modelo,
        ]);
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
     * Esta función permite cargar la tabla de posiciones de un torneo
     * @param Torneo $modelo
     */
    public function asociarFoto(&$modelo){
        if ($_FILES['Torneos']['error'] !== UPLOAD_ERR_OK) {
            $files = CArchivoCargado::instanciarModelo('Torneos', 'tabla_posiciones');
            $rutaDestino = Sis::resolverRuta(Sis::crearCarpeta("!publico.imagenes.torneos.fotos"));
            $rutaThumbs = Sis::resolverRuta(Sis::crearCarpeta("!publico.imagenes.torneos.fotos.thumbs"));
            $nom = $files->getNombre();
            if($files->guardar($rutaDestino, $nom)){
                $modelo->tabla_posiciones =  $nom . "." . $files->getExtension();
                $files->thumbnail($rutaThumbs, [
                    'tamanio' => '400',
                    'tipo' => strtolower($files->getExtension()),
                ]);
            }
        }
        
    }
    
    /**
     * Esta función permite cargar un modelo usando su primary key
     * @param int $pk
     * @return Torneo
     */
    private function cargarModelo($pk){
        return Torneo::modelo()->porPk($pk);
    }
}
