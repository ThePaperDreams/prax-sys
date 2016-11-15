<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar EstadosPublicacion' => ['EstadoPublicacion/inicio'],        
        'Registrar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['EstadoPublicacion/inicio'],
        ]
    ];    
?>
<div class="col-sm-8">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo]); ?>
</div>
