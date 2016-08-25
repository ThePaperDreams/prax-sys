<?php
class CtrlPermiso extends CControlador{

    public function accionAsignar(){
        $this->consultarPermisos();
        $this->guardarPermiso();
        
        $mRoles = Rol::modelo()->listar();
        $mModulos = Modulo::modelo()->listar();
        
        $this->vista('permisos', [
            'roles' => CHtml::modeloLista($mRoles, 'id_rol', 'nombre'),
            'modulos' => CHtml::modeloLista($mModulos, 'id', 'nombre'),
        ]);
    }
    
    private function guardarPermiso(){
        if(isset($this->_p['ajx_save'])){
            $existente = $this->_p['esNuevo'];
            $id = isset($this->_p['id'])? $this->_p['id'] : 0;
            $idRol = $this->_p['id_rol'];
            $ruta = $this->_p['id_ruta'];
            $estado = $this->_p['estado'];
            
            if($existente == "true"){
                $permiso = RutaRol::modelo()->porPk($id);                
            } else {
                $permiso = new RutaRol();
            }
            $permiso->estado = $estado;
            $permiso->rol_id = $idRol;
            $permiso->ruta_id = $ruta;
            $error = !$permiso->guardar(); # si se guarda correctamente (true) no hubo error, por eso lo negamos                
            $this->json([
                'error' => $error,
                'id' => $permiso->id_rxr,
            ]);
            Sis::fin();
        }
    }
    
    private function consultarPermisos(){
        if(isset($this->_p['ajx'])){
            $query = "SELECT
                                t.id_rxr,
                                t.rol_id,
                                t2.id_ruta,
                                t3.nombre nombre_rol,
                                (CASE WHEN t.rol_id = '" . $this->_p['id_rol'] . "' THEN t.estado ELSE 0 END) as estado, 
                                t2.nombre nombre_ruta,
                                t2.ruta,
                                t2.modulo_id
                        FROM
                                tbl_rutas_x_rol t
                        RIGHT JOIN tbl_rutas t2 ON t2.id_ruta = t.ruta_id
                        LEFT JOIN tbl_roles t3 ON t3.id_rol = t.rol_id
                        WHERE (t.rol_id IS NULL OR t.rol_id = '" . $this->_p['id_rol'] . "' OR t.rol_id <> '" . $this->_p['id_rol'] . "') AND 
                     t2.modulo_id = '" . $this->_p['id_mod'] . "'";
            # ejecutar comando recibe la consulta y luego un bool para devolver un 
            # array asociativo o un array de objetos
//            echo $query;
//            exit();
            $resultados = Sis::apl()->bd->ejecutarComando($query, true);
            $html = [];
            foreach($resultados AS $r){
                $opciones = ['class' => 'input-exception']; # separo las opciones html en una variable
                                                    # de esta manera puedo validar si pongo el check seleccionado
                                                    # o no
                # si existe el rol en los resultados y el estado es uno, tiene permiso
                # de lo contrario, no tiene, pero el registro existe
                if($r->rol_id != "" && $r->estado == 1){
                    $opciones['checked'] = true;
                    $opciones['data-exist'] = true;
                    $opciones['data-id'] = $r->id_rxr; # capturamos el id para actualizarlo
                } else if($r->rol_id != "" && $r->estado == 0){
                    $opciones['data-exist'] = true;
                    $opciones['data-id'] = $r->id_rxr; # capturamos el id para actualizarlo
                }
                
                $opciones['onclick'] = "guardarPermiso($(this))";
                $opciones['data-id-ruta'] = $r->id_ruta;
                
                $input = CHtml::input('checkbox', '', $opciones);
                $td = CHtml::e('td', $input);
                $td .= CHtml::e('td', $r->nombre_ruta);
                $td .= CHtml::e('td', $r->ruta);                
                $html[] = CHtml::e('tr', $td);                
            }
            # esta función json ya nos hace el cruce de decir que la respuesta es un json y además
            # ella misma imprime el resultado
            $this->json([
                'error' => false,
                'html' => implode('', $html), # según leí es más optimo concatenar en un array que en un string
                                            # por eso guardo los tr en un array y luego lo paso a string, no me consta que optimice 
            ]);
            
            Sis::fin();
        }
    }
   
}


