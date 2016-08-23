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

    /**
     * Esta función permite crear un nuevo registro
     */
    public function accionCrear() {
        $modelo = new Entrada();
        if (isset($this->_p['Entradas'])) {
            $modelo->atributos = $this->_p['Entradas'];
            $modelo->fecha_realizacion = date("Y-m-d H:i:s");
            if ($modelo->guardar()) {
                foreach ($this->_p['Entradas'] as $key => $artc) {
                    $mdEI = new EntradaImplemento();
                    $mdEI->cantidad = $this->_p['Entradas'][$key];
                    $mdEI->implemento_id = $artc;
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
