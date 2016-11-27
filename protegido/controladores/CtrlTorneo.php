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
        $c = new CCriterio();
        $c->orden("id_torneo", false);

        $this->mostrarVista('inicio', ['criterios' => $c]);
    }

    public function accionRegistrarResultados($id){

        if(isset($this->_p['data-save-fields'])){
            $this->guardarCampos($this->_p);
            Sis::fin();
        }

        $torneo = $this->cargarModelo($id);
        $this->vista('registrarResultados', [
            'torneo' => $torneo,
            'equipos' => $torneo->Equipos,
        ]);
    }

    private function guardarCampos($campos){
        $registro = DeportistaEquipo::modelo()->porPk($campos['jug-id']);
        $registro->anotaciones = $campos['anotaciones'];
        $registro->amonestaciones = $campos['amonestaciones'];
        $registro->expulsiones = $campos['expulsiones'];
        $this->json([
            'error' => !$registro->guardar(),
        ]);
    }
    
    private function guardarEquipos($equipos, $torneo){
        $error = false; 
        Sis::apl()->bd->begin();
        foreach($equipos AS $k=>$equipo){
            if(isset($equipo['editar'])){
                $nuevoEquipo = Equipo::modelo()->porPk($k);
            } else {
                $nuevoEquipo = new Equipo();
            }
            $nuevoEquipo->nombre = $equipo['nombre'];
            $nuevoEquipo->cupo_maximo = $equipo['cupo-max'];
            $nuevoEquipo->cupo_minimo = $equipo['cupo-min'];
            $nuevoEquipo->entrenador_id = $equipo['entrenador'];
            $nuevoEquipo->torneo_id = $torneo;
            $deportistas = isset($equipo['deportistas'])? $equipo['deportistas'] : [];
            if($nuevoEquipo->guardar() && $this->guardarJugadores($deportistas, $nuevoEquipo->id_equipo)){
                Sis::Sesion()->flash("alerta", [
                    'tipo' => 'success',
                    'msg' => 'Se guardó correctamente la información',
                ]); 
            } else {
                $error = true;
                Sis::Sesion()->flash("alerta", [
                    'tipo' => 'error',
                    'msg' => 'Ocurrió un error al guardar la información',
                ]); 
            }
        }
        if($error){
            Sis::apl()->bd->rollback();
        } else {
            Sis::apl()->bd->commit();
        }
        unset($_POST['equipos']);
        $this->redireccionar('inicio');
    }
    
    private function guardarJugadores($jugadores, $equipo_id){
        $ok = true;
        foreach($jugadores AS $k=>$v){
            $de = new DeportistaEquipo();
            $de->equipo_id = $equipo_id;
            $de->deportista_id = $v;
            $ok = $de->guardar();
            if($ok === false){ break; }
        }
        return $ok;
    }
    
    public function accionGestionarEquipos($id){
//        $d = Deportista::modelo()->porPk(13);
//        var_dump($d->Ficha->Pos);
//        Sis::fin();
        
        $categorias = Categoria::modelo()->listar([
            'where' => 'estado = 1'
        ]);
        
//        ini_set('xdebug.var_display_max_depth', 5);
//        ini_set('xdebug.var_display_max_children', 256);
//        ini_set('xdebug.var_display_max_data', 1024);
//        var_dump($this->_p);
//        exit();                
        
        if(isset($this->_p['deportista-remover'])){
            $this->removerJugadores($this->_p['deportista-remover']);
        }
        
        if(isset($this->_p['equipos-remover'])){
            $this->removerEquipos($this->_p['equipos-remover']);
        }
        
        if(isset($this->_p['equipos'])){            
            $this->guardarEquipos($this->_p['equipos'], $id);
        }
        
        $c = new CCriterio();
        $c->condicion("rol_id", 4);
        $usuarios = Usuario::modelo()->listar($c);
        $torneo = $this->cargarModelo($id);
        
        $this->vista('gestionarEquipos', [
            'torneo' => $torneo,
            'categorias' => CHtml::modeloLista($categorias, "id_categoria", "nombre"),
            'usuarios' => CHtml::modeloLista($usuarios, "id_usuario", "nombres"),            
        ]);
    }
    
    private function removerEquipos($equipos){
        foreach($equipos AS $e){
            $equipo = Equipo::modelo()->porPk($e);
            $jugadores = $equipo->JugadoresE;
            foreach($jugadores AS $j){ $j->eliminar(); }
            $equipo->eliminar();
        }
        unset($_POST['equipos-remover']);
    }

    public function accionReporte(){
        if(!isset($this->_p['modelo'])){
            $this->redireccionar('inicio');
        }

        $this->tituloPagina = "Torneos praxis";
        // $this->tituloPagina = str_replace(' ', '-', $this->tituloPagina);

        $campos = $this->_p['modelo'];
        foreach($campos AS $k=>$v){ $campos[$k] = $v == ''? null : $v; }

        $c = new CCriterio();
        
        $c->condicion("nombre", $this->nombre, "LIKE")
                ->y("cupo_minimo", $this->cupo_minimo, "=")
                ->y("edad_maxima", $this->edad_maxima, "=")
                ->y("fecha_inicio", $this->fecha_inicio, "=");

        $torneos = Torneo::modelo()->listar($c);

        $this->plantilla = "reporte";
        $pdf = Sis::apl()->mpdf->crear();
        ob_start();
        $this->vista('reporte', ['torneos' => $torneos]);
        $texto = ob_get_clean();
        $pdf->writeHtml($texto);
        $pdf->Output("$this->tituloPagina.pdf", 'I');
    }
    
    private function removerJugadores($jugadores){
        foreach($jugadores AS $aRemover){
            $c = new CCriterio();
            $c->condicion("deportista_id", $aRemover['deportista'])
                ->y("equipo_id", $aRemover['equipo']);
            $equipoJugador = DeportistaEquipo::modelo()->primer($c);
            if($equipoJugador !== null && !$equipoJugador->eliminar()){
                throw new CExAplicacion("Error al remover el deportista del equipo.");
            }
        }
        unset($_POST['deportista-remover']);
    }


    
    public function accionAjx(){
        if(!isset($this->_p['ajx'])){ Sis::fin(); }
        $id = $this->_p['id'];
        $categoria = Categoria::modelo()->porPk($id);
        $edad = $this->_p['edad'];        
        // $cond = '';
        // $c = new CCriterio();
        $cond = "AND fn_get_edad_deportistas(t2.id_deportista) <= $edad ";
        if(isset($this->_p['deportistas'])){ 
            $cond = 'AND deportista_id NOT IN(' . implode(',', $this->_p['deportistas']) . ')'; 
        }

        $deportistas =  $categoria->getDeportistasMatriculados($cond);
        
        $html = '';
        foreach($deportistas AS $deportista){
            $html .= $this->vistaP('_itemDeportista', ['deportista' => $deportista]);
        }

        if($html == ""){
            $t = "No hay jugadores matriculados para esta categoría o no tienen edad para participar en este torneo";
            $html = CHtml::e('div', $t, ['class' => 'alert alert-warning']);
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
        $equipos = $modelo->Equipos;
        rsort($equipos);
        $this->mostrarVista('ver', [
            'modelo' => $modelo,
            'equipos' => $equipos,
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
            // var_dump($rutaDestino, file_exists($rutaDestino));
            // exit();
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
