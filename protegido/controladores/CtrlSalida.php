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
        $modelo = new Salida();
        if(isset($this->_p['Salidas'])){
            $modelo->atributos = $this->_p['Salidas'];
            $modelo->fecha_realizacion = date('Y-m-d H:i:s');
//            echo "<pre>";
//            var_dump($modelo);exit();
            
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
    
    public function accionAnular($pk) {
        $modelo = $this->cargarModelo($pk);
        $modelo->estado = !$modelo->estado;
        if ($modelo->guardar()) {
            Sis::Sesion()->flash("alerta", [
                'msg' => 'Modificación exitosa',
                'tipo' => 'success',
            ]);
        } else {
            # lógica para error al borrar
        }
        $this->redireccionar('inicio');
    }

    /**
     * Esta función permite ver detalladamente un registro existente
     * @param int $pk
     */
    public function accionVer($pk){
        $modelo = $this->cargarModelo($pk);
        $this->mostrarVista('ver', ['modelo' => $modelo]);
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
