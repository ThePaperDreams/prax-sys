<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CtrlDeportista
 *
 * @author JAKO
 */
class CtrlDeportista extends CControlador{
    public function accionInicio(){
        $modelo = new Deportista();
        $depo = Deportista::modelo()->porPk(2);
//        var_dump($depo->acudientes);
        $acud = $depo->acudientes;
        foreach ($acud AS $a){
            echo "$a->nombreCompleto <br>";
        }
        exit();
        if(isset($_POST['btn-cargar'])){
//            $foto = $_FILES['foto'];
//            var_dump($foto);
//            move_uploaded_file($foto['tmp_name'], Sis::resolverRuta("!recursos") . '/mi_imagen.jpg');
//            var_dump($_POST, $_FILES);
            $foto = CArchivoCargado::instanciarPorNombre('foto');
            $rutaDestino = Sis::resolverRuta(Sis::crearCarpeta("!publico.deportistas.fotos"));
            $foto->guardar($rutaDestino, "kasumy");
            var_dump($foto->getExtension());
            exit();
        }
        
        $this->vista("cargar", [
            'deportista' => $modelo
        ]);
    }
}
