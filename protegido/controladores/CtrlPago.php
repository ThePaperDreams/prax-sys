<?php

class CtrlPago extends CControlador{
    
    public function accionPagosPendientes(){
        if(isset($this->_p['ajaxSearch'])){
            $this->consultarPagos();
        }
        
        $deportistas = Matricula::listarDeportistas();
        $this->vista("pagosPendientes", [
            'deportistas' => $deportistas,
        ]);
    }
    
    public function accionReporte(){
        if(!isset($this->_p['modelo'])){
            $this->redireccionar('inicio');
        }

        $this->tituloPagina = "Pagos-realizados-praxis";
        $campos = $this->_p['modelo'];
        foreach($campos AS $k=>$v){ $campos[$k] = $v == ''? null : $v; }

        $c = new CCriterio();
        $concat = "CONCAT_WS(' ', d.nombre1,d.apellido1)";
        $c->union("tbl_matriculas", "m")
            ->donde("m.id_matricula", "=", "t.matricula_id")
            ->union("tbl_categorias", "ca")
            ->donde("ca.id_categoria", "=", "m.categoria_id")
            ->union("tbl_deportistas", "d")
            ->donde("d.id_deportista", "=", "m.deportista_id")
            ->condicion($concat, $campos['matricula_id'], "LIKE")
            ->y("t.estado", $campos['estado'], "=")
            ->y("t.descuento", $campos['descuento'], "LIKE")
            ->y("t.fecha", $campos['fecha'], "LIKE")
            ->y("t.valor_cancelado", $campos['valor_cancelado'], "LIKE")
            ->y("ca.nombre", $campos['_categoria'], 'LIKE');

        $modelos = Pago::modelo()->listar($c);
        
        $this->plantilla = "reporte";
        $pdf = Sis::apl()->mpdf->crear();
        ob_start();
        $this->vista('reporte', ['pagos' => $modelos]);
        $texto = ob_get_clean();
        $pdf->writeHtml($texto);
        $pdf->Output("$this->tituloPagina.pdf", 'I');
    }

    /**
     * Los pagos de los deportistas son calculados desde que inicia la matricula hasta dos meses
     * después de la fecha actual
     */
    public function consultarPagos(){
        
        $id = $this->_p['idDep'];
        $matricula = Matricula::modelo()->porPk($id);
        $fechaMatricula = new DateTime($matricula->fecha_pago);
        $fechaInicio = new DateTime($fechaMatricula->format('Y-m'));
        $fechaActual = new DateTime();
        $fechaActual->modify('+2 month');
        $fechaFin = new DateTime($fechaActual->format('Y-m'));
        
                
        $intervalo = DateInterval::createFromDateString("1 month");
        $periodo = new DatePeriod($fechaInicio, $intervalo, $fechaFin);
        
        $html = "";
        
        foreach($periodo AS $meses){
            $d = $meses->format('d');
            $m = $meses->format('m');
            $y = $meses->format('Y');
            $pago = Pago::modelo()->primer(['where' => "matricula_id= '$id' AND fecha = '$y-$m-$d' AND estado = 1"]);
            if($pago !== null){ continue; }
            
            $html .= '<tr>';
            $html .= '<td>pago pendiente para el mes  ' . $m . ' de ' . $y . '</td>';
            $html .= "<td>$y-$m-$d</td>";
            $html .= '<td> $ ' . number_format($matricula->Categoria->tarifa) . '</td>';
            $html .= '<td>'
                    . '<a href="' . Sis::crearUrl(['pago/registrar', "id" => $matricula->id_matricula, 'fecha' => "$y-$m-$d"]) . '">'
                    . '<button class="btn btn-primary">Registrar pago</button>'
                    . '</a>'
                    . '</td>';
            $html .= '</tr>';
        }
        
        $this->json([
            'error' => false,
            'html' => $html,
        ]);
        
        Sis::fin();
    }
    
    public function accionRegistrar($pk){
        $matricula = Matricula::modelo()->porPk($pk);
        $pago = new Pago();
        $pago->matricula_id = $pk;
        $pago->valor_cancelado = $matricula->Categoria->tarifa;
        $pago->fecha = $this->_g['fecha'];
        
        if(isset($this->_p['Pagos'])){
            $pago->atributos = $this->_p['Pagos'];
            $archivoGuardado = $this->guardarComprobantePago($pago, $matricula->Deportista->identificacion, $pago->fecha);
            if(!$archivoGuardado && $pago->guardar()){
                Sis::Sesion()->flash("alerta", [
                    'msg' => 'Guardado exitoso',
                    'tipo' => 'success',
                ]);
                $this->redireccionar('consultar');
            }else {
                Sis::Sesion()->flash("alerta", [
                    'msg' => 'Error al guardar el pago',
                    'tipo' => 'error',
                ]);
            }
        }
        
        $this->vista('registrarPago', [
            'modelo' => $pago,
            'matricula' => $matricula,
        ]);
    }
    /**
     * 
     * @param Pago $pago
     */
    private function guardarComprobantePago(&$pago, $documento, $fecha){
        $ruta = Sis::crearCarpeta('!publico.documentos.pagos');
        $rutaDestino = Sis::resolverRuta($ruta);
        $archivo = CArchivoCargado::instanciarModelo('Pagos', 'url_comprobante');
        if($archivo->getError() === CArchivoCargado::NINGUNO){
            $nombreArchivo = "comprobante-$documento-$fecha";
            $pago->url_comprobante = $nombreArchivo . "." . $archivo->getExtension();
            return !$archivo->guardar($rutaDestino, $nombreArchivo);
        }
        return true;
    }
    
    public function accionGenerarReporte() {
        $pagos = Pago::modelo()->listar([
            'where' => 'estado=1',
        ]);
        
        $pdf = Sis::apl()->mpdf->crear();
        $texto = $this->vistaP('pdfPago', ['pagos' => $pagos]);
        $pdf->writeHtml($texto);
        $pdf->Output("Pago_de_mensualidades.pdf", 'I');
    }
    
    public function accionConsultar(){           
        $pagos = Pago::modelo()->listar([
//            'where' => 'estado=1',
        ]);
        
        $this->vista('consultarPagos',[
            'pagos' => $pagos,
        ]);
    }
    
    public function accionAnular($id){
        $modelo = Pago::modelo()->porPk($id);
        if ($modelo->estado==0) {
             Sis::Sesion()->flash("alerta", [
                    'msg' => 'Esta categoria ya se encuentra inactiva',
                    'tipo' => 'error',
                ]);
             $this->redireccionar('inicio');
        }
        $modelo->estado = $modelo->estado == 1? 0 : 1;
        $modelo->guardar();
        Sis::Sesion()->flash("alerta", [
                'msg' => 'Guardado exitoso',
                'tipo' => 'success',
            ]);
        $this->redireccionar('pago/consultar');
    }
    
    public function accionVer($pk){
        $modelo = Pago::modelo()->porPk($pk);
        $this->vista('ver', [
            'modelo' => $modelo
        ]);
    }
}
