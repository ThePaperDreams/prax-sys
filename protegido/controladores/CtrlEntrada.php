<?php

/**
 * Este es el controlador Entrada, desde aquí se gestionan
 * todas las actividades que tengan que ver con Entrada
 * @author Jorge Alejandro Quiroz Serna <alejo.jko@gmail.com>
 * @version 1.0.0
 */
class CtrlEntrada extends CControlador {

    /**
     * Esta función muestra el inicio y una tabla para listar los datos
     */
    public function accionInicio() {
        $modelos = Entrada::modelo()->listar();
        $this->mostrarVista('inicio', ['modelos' => $modelos]);
    }

    public function accionImprimir($id){
        $modelo = $this->cargarModelo($id);

        if($modelo === null){
            $this->redireccionar('inicio');
        }

        $this->tituloPagina = "Entrada-$id-praxis";

        $this->plantilla = "reporte";
        $pdf = Sis::apl()->mpdf->crear();
        ob_start();
        $this->vista('imprimir', ['modelo' => $modelo]);
        $texto = ob_get_clean();
        // echo $texto;
        // exit();
        $pdf->writeHtml($texto);
        $pdf->Output("$this->tituloPagina.pdf", 'I');
    }

    public function accionReporte(){
        if(!isset($this->_p['modelo'])){
            $this->redireccionar('inicio');
        }

        $this->tituloPagina = "Entradas-de-implementos-praxis";
        $campos = $this->_p['modelo'];
        foreach($campos AS $k=>$v){ $campos[$k] = $v == ''? null : $v; }

        $c = new CCriterio();
        $concat = "CONCAT_WS(' ',t1.nombres)";
        $c->union("tbl_usuarios", "t1")
           ->donde("t1.id_usuario", "=", "t.responsable_id")
           ->condicion($concat, $campos['responsable_id'], "LIKE")
           ->y("t.estado", $campos['estado'], "=")
           ->y("t.fecha_realizacion", $campos['fecha_realizacion'], "LIKE")
           ->orden('t.fecha_realizacion', false);

        $entradas = Entrada::modelo()->listar($c);

        $this->plantilla = "reporte";
        $pdf = Sis::apl()->mpdf->crear();
        ob_start();
        $this->vista('reporte', ['entradas' => $entradas]);
        $texto = ob_get_clean();
        $pdf->writeHtml($texto);
        $pdf->Output("$this->tituloPagina.pdf", 'I');
    }

    /**
     * Esta función permite crear un nuevo registro
     */
    public function accionCrear() {
        $modelo = new Entrada();
        if (isset($this->_p['Entradas'])) {
            $modelo->atributos = $this->_p['Entradas'];
            $modelo->fecha_realizacion = date("Y-m-d H:i:s");
            /*echo "<pre>";
            foreach ($this->_p['Entradas'] as $key => $artc) {
                var_dump($this->_p['Entradas'],$key, $artc, $this->_p['cantity']);
            }
            exit();*/
            if ($modelo->guardar()) {
                foreach ($this->_p['articulo'] as $key => $artc) {
                    $mdEI = new EntradaImplemento();
                    $mdEI->cantidad = $this->_p['cantity'][$key];
                    $mdEI->implemento_id = $this->_p['articulo'][$key];
                    $mdEI->entrada_id = $modelo->id_entrada;
                    $mdEI->guardar();
                    $mdEI->Implemento->unidades = $mdEI->Implemento->unidades + $mdEI->cantidad;
                    $mdEI->Implemento->guardar();
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
    public function accionVer($pk) {
        $modelo = $this->cargarModelo($pk);
        $this->mostrarVista('ver', ['modelo' => $modelo]);
    }
    
    public function accionAnular($pk) {
        $modelo = $this->cargarModelo($pk);
        $modelo->estado = $modelo->estado ==1 ? 0:1;
        
        if ($modelo->guardar()) {
                Sis::Sesion()->flash("alerta", [
                    'msg' => 'Cambio exitoso',
                    'tipo' => 'success',
                ]);
        } else {
            
        }
        
        $this->redireccionar('inicio');
    }

    /**
     * Esta función permite cargar un modelo usando su primary key
     * @param int $pk
     * @return Entrada
     */
    private function cargarModelo($pk) {
        return Entrada::modelo()->porPk($pk);
    }

}
