<?php 
    $this->tituloPagina = "Registrar Rol";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Roles' => ['Rol/inicio'],        
        'Registrar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Rol/inicio'],
        ]
    ];    
?>
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'rutt'=>$rutt, 'url' => $url, 'ruta'=>$ruta, 'modulo'=>$modulo, 'rutas'=>$rutas, 'modulos'=>$modulos]); ?>
</div>
