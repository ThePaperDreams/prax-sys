<?php
/**
 * Este es el controlador Torneo, desde aquí se gestionan
 * todas las actividades que tengan que ver con Torneo
 * @author Jorge Alejandro Quiroz Serna <alejo.jko@gmail.com>
 * @version 1.0.0
 */
class CtrlTorneo extends CControlador{
    
    /**
     * Esta función muestra el inicio y una tabla para listar los datos
     */
    public function accionInicio(){
        $modelos = Torneo::modelo()->listar();        
        $this->mostrarVista('inicio', ['modelos' => $modelos]);
    }
    
    /**
     * Esta función permite crear un nuevo registro
     */
    public function accionCrear(){
        $modelo = new Torneo();
        if(isset($this->_p['Torneos'])){
            $modelo->atributos = $this->_p['Torneos'];
            $modelo->tabla_posiciones = $this->asociarFoto($modelo->nombre); 
            if($modelo->guardar()){
                # lógica para guardado exitoso
                $this->redireccionar('inicio');
            }
        }
        $this->mostrarVista('crear', ['modelo' => $modelo]);
    }
    
    /**
     * Esta función permite editar un registro existente
     * @param int $pk
     */
    public function accionEditar($pk){
        $modelo = $this->cargarModelo($pk);
        if(isset($this->_p['Torneos'])){
            $modelo->atributos = $this->_p['Torneos'];
            if($modelo->guardar()){
                # lógica para guardado exitoso
                $this->redireccionar('inicio');
            }
        }
        $this->mostrarVista('editar', ['modelo' => $modelo]);
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
    
    public function asociarFoto($dep){
        if (empty($_FILES['torneos']['name']['tabla_posiciones']) === false) {
            $files = CArchivoCargado::instanciarModelo('Torneos', 'tabla_posiciones');
            $rutaDestino = Sis::resolverRuta(Sis::crearCarpeta("!publico.imagenes.torneos.fotos"));
            $rutaThumbs = Sis::resolverRuta(Sis::crearCarpeta("!publico.imagenes.torneos.fotos.thumbs"));
            $nom = "Foto_$dep";
            if($files->guardar($rutaDestino, $nom)){
                $files->thumbnail($rutaThumbs, [
                    'tamanio' => '400',
                    'tipo' => strtolower($files->getExtension()),
                ]);
            }      
            $nom .= ".".$files->getExtension();
            return $nom;
        }else{
            return "";
        }
        
    }
    
    /**
     * Esta función permite cargar un modelo usando su primary key
     * @param int $pk
     * @return Torneo
     */
    private function cargarModelo($pk){
        return Torneo::modelo()->porPk($pk);
    }
}
