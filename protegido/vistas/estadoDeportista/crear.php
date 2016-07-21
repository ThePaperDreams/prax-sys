<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar EstadoDeportistas' => ['EstadoDeportista/inicio'],        
        'Crear'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['EstadoDeportista/inicio'],
        ]
    ];    
?>
<div class="col-sm-12">
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo]); ?>
</div>
