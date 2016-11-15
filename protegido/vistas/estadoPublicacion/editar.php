<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar EstadosPublicacion' => ['EstadoPublicacion/inicio'],        
        'Actualizar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['EstadoPublicacion/inicio'],
            'Registrar' => ['EstadoPublicacion/crear'],
        ]
    ];    
?>
<div class="col-sm-8">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo]); ?>
</div>
