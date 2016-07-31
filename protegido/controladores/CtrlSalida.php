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
        Sis::apl()->bd->begin(); # inicia la transacción
        # recorremos las devoluciones
        foreach($devoluciones['id'] AS $k=>$d){
            $detalle = SalidaImplemento::modelo()->porPk($d); # instanciamos el detalle. Recordemos que un detalle tiene la información de el producto y cuantas unidades se prestaron
            $detalle->cantidad_devuelta = $d['cantidad'][$k];
            $error = !$detalle->guardar(); # si ocurrio un error al guardar el detalle
            if($error == true){ break;} # si courrio error no continuamos con el ciclo
            
            $unidades = $detalle->Implemento->unidades; # capturamos las unidades actuales de ese implemento
            $detalle->Implemento->unidades = intval($unidades) + intval($d['cantidad'][$k]); # actualizamos las unidades del implemento
            $error = !$detalle->Implemento->guardar();
            if($error == true){ break;}
        }
        # si no hubo error
        if(!$error){
            $salida = Salida::modelo()->porPk($id); # instanciamos la salida
            $salida->estado = 2;
            $salida->guardar();
            Sis::apl()->bd->commit();
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
            Sis::apl()->bd->rollback();
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
