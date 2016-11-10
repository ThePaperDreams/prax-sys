<?php
/**
 * Este es el controlador Salida, desde aquí se gestionan
 * todas las actividades que tengan que ver con Salida
 * @author Jorge Alejandro Quiroz Serna <alejo.jko@gmail.com>
 * @version 1.0.0
 */
class CtrlSalida extends CControlador{
    
    /**
     * Esta función muestra el inicio y una tabla para listar los datos
     */
    public function accionInicio(){
        $modelos = Salida::modelo()->listar();        
        $this->mostrarVista('inicio', ['modelos' => $modelos]);
    }

    public function accionImprimir($id){
        $modelo = $this->cargarModelo($id);

        if($modelo === null){
            $this->redireccionar('inicio');
        }

        $this->tituloPagina = "Préstamo-$id-praxis";

        $this->plantilla = "reporte";
        $pdf = Sis::apl()->mpdf->crear();
        ob_start();
        $this->vista('imprimir', ['modelo' => $modelo]);
        $texto = ob_get_clean();
        $pdf->writeHtml($texto);
        $pdf->Output("$this->tituloPagina.pdf", 'I');
    }

    public function accionReporte(){
        if(!isset($this->_p['modelo'])){
            $this->redireccionar('inicio');
        }

        $this->tituloPagina = "Pŕestamo-de-implementos-praxis";
        $campos = $this->_p['modelo'];
        foreach($campos AS $k=>$v){ $campos[$k] = $v == ''? null : $v; }

        $c = new CCriterio();
        $concat = "CONCAT_WS(' ',t1.nombres)";
        $c->union("tbl_usuarios", "t1")
           ->donde("t1.id_usuario", "=", "t.responsable_id")
           ->condicion($concat, $campos['responsable_id'], "LIKE")
           ->y("t.estado", $campos['estado'], "=")
           ->y("t.fecha_realizacion", $campos['fecha_realizacion'], "LIKE")
           ->y("t.fecha_entrega", $campos['fecha_entrega'], "LIKE")
           ->orden('t.fecha_realizacion', false);

        $salida = Salida::modelo()->listar($c);

        $this->plantilla = "reporte";
        $pdf = Sis::apl()->mpdf->crear();
        ob_start();
        $this->vista('reporte', ['salidas' => $salida]);
        $texto = ob_get_clean();
        $pdf->writeHtml($texto);
        $pdf->Output("$this->tituloPagina.pdf", 'I');
    }
    
    /**
     * Esta función permite crear un nuevo registro
     */
    public function accionCrear(){
        
        if(isset($this->_p['ajaxRequest'])){
            $implemento = Implemento::modelo()->porPk($this->_p['id']);
            $this->json([
                'unidades' => $implemento->unidades,
            ]);
            Sis::fin();
        }
        
        $modelo = new Salida();
        if(isset($this->_p['Salidas'])){
            $modelo->atributos = $this->_p['Salidas'];
            $modelo->fecha_realizacion = date('Y-m-d H:i:s');
            
            if($modelo->guardar()){
                
                foreach ($_POST["articulo"] as $key => $artc){
                    $mdSI = new SalidaImplemento();
                    $mdSI->cantidad = $_POST["cantity"][$key];
                    $mdSI->implemento_id = $artc;
                    $mdSI->salida_id=$modelo->id_salida;
                    $mdSI->guardar();
                    $mdSI->Implemento->unidades = $mdSI->Implemento->unidades - $mdSI->cantidad;
                    $mdSI->Implemento->guardar();
                } 
                Sis::Sesion()->flash("alerta", [
                'msg' => 'Guardado exitoso',
                'tipo' => 'success',
            ]);
                $this->redireccionar('inicio');
            }
        }
        $usuarios = CHtml::modeloLista(Usuario::modelo()->listar(), "id_usuario", "nombres");
        $this->mostrarVista('crear', ['modelo' => $modelo, 'usuarios' => $usuarios]);
    }

    /**
     * Esta función permite ver detalladamente un registro existente
     * @param int $pk
     */
    public function accionVer($pk){
        $modelo = $this->cargarModelo($pk);
        $this->mostrarVista('ver', ['modelo' => $modelo]);
    }
    
     public function accionAnular($pk) {
        $modelo = $this->cargarModelo($pk);
        $modelo->estado = $modelo->estado ==1 ? 0 : 1;
        # empezamos la transacción
        Sis::apl()->bd->begin();
        if ($modelo->guardar() && $this->devolverImplementos($modelo)) {            
            Sis::apl()->bd->commit();
            Sis::Sesion()->flash("alerta", [
                'msg' => 'Cambio exitoso',
                'tipo' => 'success',
            ]);
        } else {
            Sis::apl()->bd->rollback();
            Sis::Sesion()->flash("alerta", [
                'msg' => 'Ocurrió un error al cambiar el estado',
                'tipo' => 'error',
            ]);
        }
        
        $this->redireccionar('inicio');
    }
    
    /**
     * @param Salida $modelo
     */
    private function devolverImplementos($modelo){
        $detalles = $modelo->Detalles;
        foreach($detalles AS $d){
            $cantPres = intval($d->cantidad);
            $cantAct = intval($d->Implemento->unidades);
            $nueva = $cantAct + $cantPres;
            $d->Implemento->unidades = $nueva;            
            if($d->Implemento->guardar() === false){
                return false;
            }
        }
        return true;
    }

    public function accionEntregar($pk){        
        $salida = Salida::modelo()->porPk($pk);        
        if(isset($this->_p['implementos'])){
            $this->guardarEntrega($pk);
        }
        
        $detalles = $salida->Detalles;

        $this->vista('entregar', [
            'modelo' => $salida,
            'detalle' => $detalles,
        ]);
    }
    
    private function guardarEntrega($id){
        $devoluciones = $this->_p['implementos']; # recibimos las devoluciones que envian en el formulario
        $error = false;        # variable para controlar errores
        
//        Sis::apl()->bd->begin(); # inicia la transacción
        # recorremos las devoluciones
        foreach($devoluciones['id'] AS $k=>$d){
            $detalle = SalidaImplemento::modelo()->porPk($d); # instanciamos el detalle. Recordemos que un detalle tiene la información de el producto y cuantas unidades se prestaron
            $detalle->cantidad_devuelta = $devoluciones['cantidad'][$k];
            $error = !$detalle->guardar(); # si ocurrio un error al guardar el detalle
            if($error == true){ break;} # si courrio error no continuamos con el ciclo
            
            $unidades = $detalle->Implemento->unidades; # capturamos las unidades actuales de ese implemento
            $detalle->Implemento->unidades = intval($unidades) + intval($devoluciones['cantidad'][$k]); # actualizamos las unidades del implemento
            $error = !$detalle->Implemento->guardar();
            if($error == true){ break;}
        }
        # si no hubo error
        if(!$error){
            $salida = Salida::modelo()->porPk($id); # instanciamos la salida
            $salida->estado = 2;
            $salida->guardar();
//            Sis::apl()->bd->commit();
            Sis::Sesion()->flash("alerta", [
                'msg' => 'Se registró correctamente la entrega',
                'tipo' => 'success',
            ]);
            $this->redireccionar('inicio');
        } else {
            Sis::Sesion()->flash("alerta", [
                'msg' => 'Error al registrar la entrega',
                'tipo' => 'error',
            ]);
//            Sis::apl()->bd->rollback();
        }
        Sis::fin();
    }
    
    /**
     * Esta función permite cargar un modelo usando su primary key
     * @param int $pk
     * @return Salida
     */
    private function cargarModelo($pk){
        return Salida::modelo()->porPk($pk);
    }
}
