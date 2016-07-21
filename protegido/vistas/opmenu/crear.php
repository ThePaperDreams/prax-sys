<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Opmenu' => ['Opmenu/inicio'],        
        'Crear'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Opmenu/inicio'],
        ]
    ];    
?>
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'rutas'=>$rutas, 'opmenus' => $opmenus]); ?>
</div>
