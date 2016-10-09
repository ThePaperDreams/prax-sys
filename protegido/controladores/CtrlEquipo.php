<?php
/**
 * Este es el controlador Equipo, desde aquí se gestionan
 * todas las actividades que tengan que ver con Equipo
 * @author Jorge Alejandro Quiroz Serna <alejo.jko@gmail.com>
 * @version 1.0.0
 */
class CtrlEquipo extends CControlador{
    
    /**
     * Esta función muestra el inicio y una tabla para listar los datos
     */
    public function accionInicio(){
        $modelos = Equipo::modelo()->listar();        
        $this->mostrarVista('inicio', ['modelos' => $modelos,
        'deportista' => CHtml::modelolista(Deportista::modelo()->listar()
        /*'deportista' => CHtml::modelolista(Deportista::modelo()->listar([
            'where' => '',
        ])*/        
        , "id_deportista", "nombre1"),
        'Entre' => CHtml::modelolista(Usuario::modelo()->listar(), "id_usuario", "nombre_usuario"),
        'mTorneo' => CHtml::modelolista(Torneo::modelo()->listar(), "id_torneo", "nombre"),      
        ]);    
    }
    
    /**
     * Esta función permite crear un nuevo registro
     */
    public function accionCrear(){
        $this->validarNombre();
        $modelo = new Equipo();
        if(isset($this->_p['Equipos'])){
//            echo "<pre>";
            $modelo->atributos = $this->_p['Equipos'];
//            var_dump($modelo->guardar());
//            var_dump($modelo->getErrores());
//            exit();
            if($modelo->guardar()){
                $this->guardarJugadores($modelo->id_equipo);
                Sis::Sesion()->flash("alerta", [
                    'msg' => 'Guardado exitoso',
                    'tipo' => 'success',
                ]);
                # lógica para guardado exitoso
                $this->redireccionar('inicio');
            }
        }
        $url = Sis::crearUrl(['Equipo/crear']);
        $this->mostrarVista('crear', ['modelo' => $modelo,'url' => $url,
            'deportista' => CHtml::modelolista(Deportista::modelo()->listar(), "id_deportista", "nombre1"),
            'deportistas' => $modelo->getDeportistas(),
            'Entre' => CHtml::modelolista(Usuario::modelo()->listar(), "id_usuario", "nombre_usuario"),
            'mTorneo' => CHtml::modelolista(Torneo::modelo()->listar(), "id_torneo", "nombre"),  
            ]);
    }
    
    public function guardarJugadores($id){
        if(!isset($this->_p['jugadores'])){ return false; }
        foreach($this->_p['jugadores'] AS $v){
            $jugXEqui = new DeportistaEquipo();
            $jugXEqui->equipo_id = $id;
            $jugXEqui->deportista_id = $v;
            if(!$jugXEqui->guardar()){
                throw new CExAplicacion("Error al anexar jugadores al equipo");
            }
        }
    }
    
    private function eliminarJugadores() {
        if(!isset($this->_p['remover-jugadores'])){ return false; }
        foreach($this->_p['remover-jugadores'] AS $v){
            $jugXEqui = DeportistaEquipo::modelo()->porPk($v);
            if(!$$jugXEqui->eliminar()){
                throw new CExAplicacion("Error al eliminar los jugadores");
            }
        }
    }
    
    
    
    /**
     * Esta función permite editar un registro existente
     * @param int $pk
     */
    public function accionEditar($pk){
        $this->validarNombre($pk);
        $modelo = $this->cargarModelo($pk);
        if(isset($this->_p['Equipos'])){
            $modelo->atributos = $this->_p['Equipos'];
            if($modelo->guardar()){
                $this->guardarJugadores($modelo->id_equipo);
                $this->eliminarJugadores();
                # lógica para guardado exitoso
                $this->redireccionar('inicio');
            }
        }
        $url = Sis::crearUrl(['Publicacion/editar', 'id' => $pk]);
        
        $this->mostrarVista('editar', ['modelo' => $modelo,'url'=>$url,
            'deportista' => CHtml::modelolista(Deportista::modelo()->listar(), "id_deportista", "nombre1"),
            'deportistas' => $modelo->getDeportistas(),
            'Entre' => CHtml::modelolista(Usuario::modelo()->listar(), "id_usuario", "nombre_usuario"),
            'Torneo' => CHtml::modelolista(Torneo::modelo()->listar(), "id_torneo", "nombre"),  
            ]);
    }
    
    
    private function validarNombre($id = null){
        if(isset($this->_p['validarNombre'])){
            if($id === null){
                $criterio = [
                    'where' => "LOWER(nombre) = LOWER('" . $this->_p['nombre'] . "')"
                ];
            } else {
                $criterio = [
                    'where' => "id_equipo <> $id AND LOWER(nombre) = LOWER('" . $this->_p['nombre'] . "')"
                ];
            }
            $categoria = CategoriaImplemento::modelo()->primer($criterio);
            
            if($categoria != null){
                $error = true;
            } else {
                $error = false;
            }
            $this->json([
                'error' => $error,
            ]);
            Sis::fin();
        }
    }
    /**
     * Esta función permite ver detalladamente un registro existente
     * @param int $pk
     */
    public function accionVer($pk){
        $modelo = $this->cargarModelo($pk);
        $this->mostrarVista('ver', ['modelo' => $modelo,
        /*'deportista' => $modelo->MDeportistas,*/
        'deportistas' => $modelo->getDeportistas(),    
        'Entre' => CHtml::modelolista(Usuario::modelo()->listar(), "id_usuario", "nombre_usuario"),
        'mTorneo' => CHtml::modelolista(Torneo::modelo()->listar(), "id_torneo", "nombre"),    
        ]);
        
    }
    
    /**
     * Esta función permite eliminar un registro existente
     * @param int $pk
     */
    public function accionEliminar($pk){
        $modelo = $this->cargarModelo($pk);
        if($modelo->eliminar()){
            # lógica para borrado exitoso
        } else {
            # lógica para error al borrar
        }
        $this->redireccionar('inicio');
    }
    
    /**
     * Esta función permite cargar un modelo usando su primary key
     * @param int $pk
     * @return Equipo
     */
    private function cargarModelo($pk){
        return Equipo::modelo()->porPk($pk);
    }
}
