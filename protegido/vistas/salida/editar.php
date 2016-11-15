<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Salidas' => ['Salida/inicio'],        
        'Actualizar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Salida/inicio'],
            'Registrar' => ['Salida/crear'],
        ]
    ];    
?>
<div class="col-sm-8">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo]); ?>
</div>
