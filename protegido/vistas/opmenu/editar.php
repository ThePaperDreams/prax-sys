<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Opmenu' => ['Opmenu/inicio'],        
        'Actualizar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Opmenu/inicio'],
            'Crear' => ['Opmenu/crear'],
        ]
    ];    
?>
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'rutas'=>$rutas, 'opmenus' => $opmenus]); ?>
</div>
