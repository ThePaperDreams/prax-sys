<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Objetivos' => ['Objetivo/inicio'],        
        'Actualizar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Objetivo/inicio'],
            'Crear' => ['Objetivo/crear'],
        ]
    ];    
?>
<div class="col-sm-8">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo]); ?>
</div>
