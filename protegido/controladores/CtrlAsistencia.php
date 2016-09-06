<?php
/**
 * Este es el controlador Asistencia, desde aquí se gestionan
 * todas las actividades que tengan que ver con Asistencia de deportistas
 * @author Jorge Alejandro Quiroz Serna <alejo.jko@gmail.com>
 * @version 1.0.0
 */
class CtrlAsistencia extends CControlador{
    
    /**
     * Esta función muestra el inicio y una tabla para listar los datos
     */
    public function accionInicio(){
        $categorias = Categoria::modelo()->listar();        
        $usuarios = Usuario::modelo()->listar();
        $this->mostrarVista('inicio', [
            'categorias' => CHtml::modeloLista($categorias, 'id_categoria', "nombre"),
            'usuarios' => CHtml::modeloLista($usuarios, "id_usuario", "nombreMasUsuario")
        ]);
    }
    
    /**
     * Esta función permite crear un nuevo registro
     */
    public function accionTomarAsistencia(){
        $modelo = new Asistencia();
        $asistencias = isset($this->_p['matriculas'])? $this->_p['matriculas'] : [];
        if(isset($this->_p['Asistencia'])){
            $modelo->atributos = $this->_p['Asistencia'];
            if($modelo->guardar()){
                $this->guardarInasistencias($modelo->id_asistencia, $asistencias);
                Sis::Sesion()->flash("alerta", [
                    'msg' => 'Asistencia guardada exitosamente',
                    'tipo' => 'success',
                ]);
                $this->redireccionar('inicio');
            }
        }
        $this->mostrarVista('crear', ['modelo' => $modelo]);
    }
    
    private function guardarInasistencias($id, $inasistencias){
        foreach($inasistencias AS $i){
            $fm = new FaltaMatricula();
            $fm->matricula_id = $i;
            $fm->asistencia_id = $id;
            if(!$fm->guardar()){
                throw new CExAplicacion("Error al guardar la inasistencia");
            }
        }
    }
    
    public function accionAjx(){
        if(isset($this->_p['ajx']) && $this->_p['r'] == 'asistencia-listar'){
            $this->listarDeportistas();
        }
        if(isset($this->_p['ajx']) && $this->_p['r'] == 'justificar'){
            $this->justificarFalta();
        }
    }
    
    private function justificarFalta(){
        $id = $this->_p['id'];
        $justificacion = FaltaMatricula::modelo()->porPk($id);
        $justificacion->justificacion = $this->_p['justificacion'];
        if($justificacion->guardar()){
            $msg = "Se guardó la justificación correctamente";
            $error = false;
        }else {
            $msg = "Ocurrió un error al guardar la justificación";
            $error = true;
        }
        header("Content-type: application/json");
        echo json_encode([
            "msg" => $msg,
            "tipo" => $error? 'error' : 'success',
            "error" => $error,
            'j' => $justificacion->justificacion,
        ]);
    }
    
    private function listarDeportistas(){
        $id = $this->_p['id'];
        $matriculas = Matricula::modelo()->listar([
            'where' => "categoria_id=$id AND estado = 1"
        ]);
        $html = [];
        foreach($matriculas AS $m){
            $i = CHtml::input('checkbox', $m->id_matricula, ['autocomplete' => 'off', 'name' => 'matriculas[]']) . 'No asistió';
            $l = CHtml::e('label', $i, ['class' => 'btn btn-default', 'onclick'=>'toggleOp($(this))']);
            $g = CHtml::e('div', $l, ['class' => 'btn-group', 'data-toggle' => 'buttons']);
            
            $tdNombre = CHtml::e("td", $m->Deportista->NombreDePila);
            $tdOpcion = CHtml::e("td", $g);
            $html[] = CHtml::e('tr', $tdNombre . $tdOpcion, ['data-matricula' => true]);
        }
        if(count($matriculas) == 0){
            $td = CHtml::e("td", 'No hay deportistas matriculados en para esta categoría', ['class' => 'text-center', 'colspan' => 2]);
            $html[] = CHtml::e("tr", $td, ['class' => 'warning']);
        }
        header("Content-type: Application:json");
        echo json_encode([
            'html' => implode("", $html)
        ]);
    }    
    
    /**
     * Esta función permite ver detalladamente un registro existente
     * @param int $pk
     */
    public function accionVer($pk){
        $modelo = $this->cargarModelo($pk);
        $asistencias = $modelo->Faltas;
        $this->mostrarVista('ver', [
            'modelo' => $modelo,
            'asistencias' => $asistencias,
            'fechaA' => strtotime($modelo->fecha),
        ]);
    }
    
    /**
     * Esta función permite cargar un modelo usando su primary key
     * @param int $pk
     * @return Asistencia
     */
    private function cargarModelo($pk){
        return Asistencia::modelo()->porPk($pk);
    }
}
