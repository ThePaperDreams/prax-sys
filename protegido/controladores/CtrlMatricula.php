<?php

/**
 * Este es el controlador Matricula, desde aquí se gestionan
 * todas las actividades que tengan que ver con Matricula
 * @author Jorge Alejandro Quiroz Serna <alejo.jko@gmail.com>
 * @version 1.0.0
 */
class CtrlMatricula extends CControlador {

    /**
     * Esta función muestra el inicio y una tabla para listar los datos
     */
    public function accionInicio() {
        $modelos = Matricula::modelo()->listar();
        $categorias = Categoria::modelo()->listar();
        $c = new CCriterio();
        $c->condicion("t.estado", '1')
            ->orden('estado = 1', false)
            ->orden('fecha_realizacion', false);

        $this->mostrarVista('inicio', [
            'modelos' => $modelos,
            'categorias' => CHtml::modeloLista($categorias, "id_categoria", "nombre"),
            'criterios' => $c,
        ]);
    }

    public function accionCargar($pk){
        $matricula = $this->cargarModelo($pk);
        // var_dump($matricula, $_FILES);

        $doc = CArchivoCargado::instanciarPorNombre('Documentos');
        $dirDestino = Sis::resolverRuta(Sis::crearCarpeta("!publico.documentos.comprobantes.matriculas"));
        $nombre = "Matricula-" . date("Y") . "-" . $matricula->Deportista->identificacion;
        $guardado = $doc->guardar($dirDestino, $nombre);
        if($guardado){ 
            $matricula->url_comprobante = $nombre . "." . $doc->getExtension();
            if($matricula->guardar()){

            } else {

            }
            $this->redireccionar('matricula/ver', ['id' => $pk]);
        }
        var_dump($matricula);
        // $imagen = CArchivoCargado::instanciarModelo('Matriculas', 'url_comprobante');
        // return $imagen->guardar($dirDestino, $nombre)? $nombre . '.' . $imagen->getExtension() : false;
    }

    public function accionMatriculasAnuladas(){
        $modelos = Matricula::modelo()->listar();
        $categorias = Categoria::modelo()->listar();
        $c = new CCriterio();
        $c->condicion("t.estado", '0')
            ->orden('estado = 1', false)
            ->orden('fecha_realizacion', false);

        $this->mostrarVista('matriculasAnuladas', [
            'modelos' => $modelos,
            'categorias' => CHtml::modeloLista($categorias, "id_categoria", "nombre"),
            'criterios' => $c,
        ]);
    }

    /**
     * Esta función permite crear un nuevo registro
     */
    public function accionMatricular() {
        $modelo = new Matricula();
        if (isset($this->_p['Matriculas'])) {
            $modelo->atributos = $this->_p['Matriculas'];
            $modelo->url_comprobante = $this->cargarComprobante($modelo);
            if ($modelo->guardar()) {
                # actualizamos la lista de espera
                if(isset($this->_p['id_lista_espera'])){
                    $lista = ListaEspera::modelo()->porPk($this->_p['id_lista_espera']);
                    $lista->estado = 0;
                    $lista->guardar();
                    $modelo->Deportista->estado_id = 1;
                    $modelo->Deportista->guardar();
                }
                Sis::Sesion()->flash("alerta", [
                    'msg' => 'Deportista matriculado exitosamente!',
                    'tipo' => 'success',
                ]);
                $this->redireccionar('inicio');
            }
        }
        
        $deportistas = Deportista::modelo()->getNoMatriculados();
        $categorias = Categoria::modelo()->listar();
        $clubes = Club::modelo()->listar();
        
        $this->mostrarVista('crear', [
            'modelo' => $modelo,
            'deportistas' => CHtml::modeloLista($deportistas, "id_deportista", "NombreIdentificacion"),
            'categorias' => CHtml::modeloLista($categorias, "id_categoria", "nombre"),
            'clubes' => CHtml::modeloLista($clubes, "id", "nombre"),
            'mClubes' => $clubes,
        ]);
    }    
    
    public function accionReporte(){
        if(!isset($this->_p['modelo'])){
            $this->redireccionar('inicio');
        }

        $this->tituloPagina = "Matriculas - praxis";
        $campos = $this->_p['modelo'];
        foreach($campos AS $k=>$v){ $campos[$k] = $v == ''? null : $v; }
        $c = new CCriterio();
        $c->condicion('deportista_id', $campos['deportista_id'])
            ->y('estado', $campos['estado'])
            ->y('categoria_id', $campos['categoria_id'])
            ->orden("estado = 1", false)
            ->orden("fecha_realizacion", false);
        $matriculas = Matricula::modelo()->listar($c);

        $this->plantilla = "reporte";
        $pdf = Sis::apl()->mpdf->crear();
        ob_start();
        $this->vista('reporte', ['matriculas' => $matriculas]);
        $texto = ob_get_clean();
        $pdf->writeHtml($texto);
        $pdf->Output("Matriculas.pdf", 'I');
    }

    /**
     * 
     * @param Matricula $modelo
     */
    private function cargarComprobante($modelo){
        if($modelo->deportista_id === null){ return false;}        
        $imagen = CArchivoCargado::instanciarModelo('Matriculas', 'url_comprobante');
        $dirDestino = Sis::resolverRuta(Sis::crearCarpeta("!publico.documentos.comprobantes.matriculas"));        
        $nombre = "Matricula-" . date("Y") . "-" . $modelo->Deportista->identificacion;
        return $imagen->guardar($dirDestino, $nombre)? $nombre . '.' . $imagen->getExtension() : false;
    }

    public function accionAjax(){
        if(!isset($this->_p['ajx'])){
            $this->redireccionar("inicio");
        }
        if($this->_p['type'] == 'deportistas'){
            $this->consultarDeportistas();
        } else if($this->_p['type'] == "guardar-club"){
            $this->guardarClub();
        } else if($this->_p['type'] == "editar-eliminar" && isset($this->_p['r-type']) && $this->_p['r-type'] == "1"){
            # si se intenta eliminar
            $this->eliminarClub();
        }
    }

    private function eliminarClub(){
        $c = new CCriterio();
        $c->condicion("t.club_id", $this->_p['id']);
        $matriculas = Matricula::modelo()->listar($c);

        if(count($matriculas) > 0){
            $this->json([
                'error' => true,
                'msg' => 'No se puede eliminar el club debido a que ya se encuentra asignado a una o más matriculas',
            ]);
            Sis::fin();
        }

        $club = Club::modelo()->porPk($this->_p['id']);
        $error = !$club->eliminar();
        $this->json([
            'error' => $error,
            'msg' => $error == true? "Ocurrió un error al eliminar el club" : "Club eliminado correctamente",
        ]);

        Sis::fin();
    }

    private function guardarClub(){
        $c = new CCriterio();
        $c->condicion("t.nombre", $this->_p['nombre']);
        $club = Club::modelo()->primer($c);

        if($club != null){
            $this->json([
                'error' => true,
                'msg' => 'Ya esiste un club con ese nombre'
            ]);
        } else {
            $club = new Club();
            $club->nombre = $this->_p['nombre'];
            $club->telefono = $this->_p['telefono'];
            $club->direccion = $this->_p['direccion'];
            $error = !$club->guardar();
            $this->json([
                'error' => $error,
                'club_id' => $club->id,
                'nombre' => $club->nombre,
                'msg' => '',
            ]);            
        }


        Sis::fin();
    }

    private function consultarDeportistas(){
        $c = new CCriterio();
        $c->entre("fn_get_edad_deportistas(t.id_deportista)", $this->_p['min'], $this->_p['max']);        
        // $c->noEn();
        $deportistas = Deportista::modelo()->listar($c);
        $ops = [
            CHtml::e('option', 'Seleccione un deportista', ['value' => '']),
        ];
        foreach($deportistas AS $k=>$v){ 
            if($v->estaMatriculado() == false){
                $ops[] = CHtml::e('option', $v->NombreIdentificacion . " ($v->edad años) ", ['value' => $v->id_deportista]); 
            }
        }
        $this->json([
            'error' => false,
            'ops' => implode('', $ops),
        ]);
        Sis::fin();
    }
    
    public function accionValidar(){
        if(!isset($this->_p['ajx'])){
            Sis::fin();
        }
        header('Content-type: application/json');
        $id = $this->_p['id'];
        $tipo = $this->_p['type'];
        $msg = "";
        $datos = [];
        $error = false;
        if($tipo == 1){
            $matricula = Matricula::modelo()->listar([
                'where' => "deportista_id= $id AND estado = 1"
            ]);
            $error = count($matricula) > 0;
            $msg = $error? "El deportita seleccionado ya se encuentra matriculado" : "";
        } else {
            $categoria = Categoria::modelo()->porPk($id);
            $error = false;
            $datos = [
                'max' => $categoria->cupo_maximo,
                'matriculados' => $categoria->matriculados,
                'edades' => $categoria->Edad,
                'emax' => $categoria->edad_maxima,
                'emin' => $categoria->edad_minima,
            ];
        }
        echo json_encode([
            'error' => $error,
            'msg' => $msg,
            'datos' => $datos,
        ]);
        Sis::fin();
    }



    /**
     * Esta función permite ver detalladamente un registro existente
     * @param int $pk
     */
    public function accionVer($pk) {
        $modelo = $this->cargarModelo($pk);
        $this->mostrarVista('ver', ['modelo' => $modelo]);
    }

    /**
     * Esta función permite eliminar un registro existente
     * @param int $pk
     */
    public function accionAnular($pk) {
        $modelo = $this->cargarModelo($pk);
        $modelo->estado = 0;
        if ($modelo->guardar()) {
            Sis::Sesion()->flash("alerta", [
                'msg' => 'Matricula anulada',
                'tipo' => 'success',
            ]);
        } else {
            # lógica para error al borrar
        }
        $this->redireccionar('inicio');
    }
    
    public function accionListaDeEspera(){

        if(isset($this->_p['deportista'])){
            $listaEspera = new ListaEspera();
            $listaEspera->deportista_id = $this->_p['deportista'];
            $listaEspera->categoria_id = $this->_p['categoria'];
            $listaEspera->fecha_registro = date("Y-m-d");
            $listaEspera->estado = 1;

            $listaEspera->guardar();

            $deportista = Deportista::modelo()->porPk($this->_p['deportista']);
            $deportista->estado_id = 4;
            if($deportista->guardar()){
                Sis::Sesion()->flash("alerta", [
                    'msg' => 'Se envió a lista de espera el deportista',
                    'tipo' => 'success',
                ]);
                $this->redireccionar('deportista/verListaEspera');
            }
        }

        $categorias = Categoria::modelo()->listar();
        $deportistas = Matricula::getDeportistasSinMatricula();
        $this->vista("listaEspera", [
            'deportistas' => CHtml::modeloLista($deportistas, "id_deportista", "nombreDePila"),
            'categorias' => CHtml::modeloLista($categorias, "id_categoria", "nombre"),
        ]);
    }        

    /**
     * Esta función permite cargar un modelo usando su primary key
     * @param int $pk
     * @return Matricula
     */
    private function cargarModelo($pk) {
        return Matricula::modelo()->porPk($pk);
    }

}