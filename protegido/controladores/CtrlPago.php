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
    
    public function accionConsultar(){
        
    }
}
