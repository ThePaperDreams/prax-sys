<?php
/**
 * Este es el controlador PlanTrabajo, desde aquí se gestionan
 * todas las actividades que tengan que ver con PlanTrabajo
 * @author Jorge Alejandro Quiroz Serna <alejo.jko@gmail.com>
 * @version 1.0.0
 */
class CtrlPlanTrabajo extends CControlador{
    
    /**
     * Esta función muestra el inicio y una tabla para listar los datos
     */
    public function accionInicio(){
        $modelos = PlanTrabajo::modelo()->listar();        
        $this->mostrarVista('inicio', ['modelos' => $modelos]);
    }
    
    /**
     * Esta función permite crear un nuevo registro
     */
    public function accionCrear(){
        $modelo = new PlanTrabajo();        
        if(isset($this->_p['ajxrqst'])){
            $this->guardarObj();
        }        
        if(isset($this->_p['PlanesTrabajo'])){
            $modelo->atributos = $this->_p['PlanesTrabajo'];
            if($modelo->guardar()){
                $this->guardarObjetivos($modelo->id_plan_trabajo);
                Sis::Sesion()->flash("alerta", [
                    'msg' => 'Guardado exitoso',
                    'tipo' => 'success',
                ]);
                $this->redireccionar('inicio');
            }
        }
        
        $this->mostrarVista('crear', $this->getOpciones($modelo));
    }
    
    private function guardarObj(){        
        $error = false;
        $msg = "";
        $criterio = new CCriterio();
        $criterio->condicion('t.titulo', $this->_p['titulo']);
        $objExistente = Objetivo::modelo()->contar($criterio);
        
        $obj = new Objetivo;
        
        if($objExistente > 0){
            $msg = "Ya hay un objetivo con ese título";
            $error = true;
        } else {
            $obj->titulo = $this->_p['titulo'];
            $obj->descripcion = $this->_p['descripcion'];
            $error = !$obj->guardar();
            $msg = $error? 'Ocurrió un error al guardar el objetivo' : 
                'Se guardó correctamente el objetivo';
        }
        
        
        $this->json([
            'error' => $error,
            'msg' => $msg,
            'tipo' => $error? 'error' : 'success',
            'id' => $obj->id_objetivo,
            'titulo' => $obj->titulo,
        ]);
        Sis::fin();
    }
    
    /**
     * 
     * @param PlanTrabajo $modelo
     * @return []
     */
    private function getOpciones(&$modelo){
        $criterio = new CCriterio();
        if(!$modelo->nuevo){
            $criterio->noEn("id_objetivo", $modelo->idsObjetivos());
        }
        $objetivos = Objetivo::modelo()->listar($criterio);
        return [
            'modelo' => $modelo,
            'objetivos' => $objetivos,
        ];
    }
    
    public function guardarObjetivos($id){
        if(!isset($this->_p['objetivos'])){ return false; }
        foreach($this->_p['objetivos'] AS $v){
            $objXPlan = new ObjetivoPlan();
            $objXPlan->plan_id = $id;
            $objXPlan->objetivo_id = $v;
            if(!$objXPlan->guardar()){
                throw new CExAplicacion("Error al guardar los objetivos para el plan de trabajo");
            }
        }
    }
    
    private function eliminarObjetivos() {
        if(!isset($this->_p['remover-objetivos'])){ return false; }
        foreach($this->_p['remover-objetivos'] AS $v){
            $objXplan = ObjetivoPlan::modelo()->porPk($v);
            if(!$objXplan->eliminar()){
                throw new CExAplicacion("Error al eliminar los objetivos");
            }
        }
    }
    
    /**
     * Esta función permite editar un registro existente
     * @param int $pk
     */
    public function accionEditar($pk){
        $modelo = $this->cargarModelo($pk);
        if(isset($this->_p['ajxrqst'])){
            $this->guardarObj();
        }
        if(isset($this->_p['PlanesTrabajo'])){
            $modelo->atributos = $this->_p['PlanesTrabajo'];
            if($modelo->guardar()){
                $this->guardarObjetivos($modelo->id_plan_trabajo);
                $this->eliminarObjetivos();
                Sis::Sesion()->flash("alerta", [
                    'msg' => 'Guardado exitoso',
                    'tipo' => 'success',
                ]);
                $this->redireccionar('inicio');
            }
        }        
        $this->mostrarVista('editar', $this->getOpciones($modelo));
    }
    
    /**
     * Esta función permite ver detalladamente un registro existente
     * @param int $pk
     */
    public function accionVer($pk){
        $modelo = $this->cargarModelo($pk);
        $this->mostrarVista('ver', [
            'modelo' => $modelo,
            'detalles' => $modelo->MDetalles,
        ]);
    }
    
    /**
     * Esta función permite eliminar un registro existente
     * @param int $pk
     */
    public function accionEliminar($pk){
        $modelo = $this->cargarModelo($pk);
        if($modelo->estado == 1){
            $this->moverAPapelera($modelo);
        } else{
            $this->eliminarPlanTrabajo($modelo);
        }        
        $this->redireccionar('inicio');
    }
    
    /**
     * 
     * @param PlanTrabajo $modelo
     * @throws CExAplicacion
     */
    private function eliminarPlanTrabajo(&$modelo){
        $objetivos = $modelo->Detalles;
        foreach($objetivos AS $obj){ $obj->eliminar(); }
        if($modelo->eliminar()){
            Sis::Sesion()->flash("alerta", [
                'msg' => 'Se eliminó correctamente el plan de trabajo',
                'tipo' => 'success',
            ]);
        } else {
            throw new CExAplicacion("Error al eliminar el plan de trabajo");
        }
    }
    
    /**
     * 
     * @param PlanTrabajo $modelo
     */
    private function moverAPapelera(&$modelo){
        $modelo->estado = 0;
        if($modelo->guardar()){
            Sis::Sesion()->flash("alerta", [
                'msg' => 'Se movió a papelera el plan de trabajo',
                'tipo' => 'success',
            ]);
        } else {
            throw new CExAplicacion("Error al mover a papelera");
        }
    }
    
    /**
     * Esta función permite cargar un modelo usando su primary key
     * @param int $pk
     * @return PlanTrabajo
     */
    private function cargarModelo($pk){
        return PlanTrabajo::modelo()->porPk($pk);
    }
}
