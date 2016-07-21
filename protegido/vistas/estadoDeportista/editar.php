<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar EstadoDeportistas' => ['EstadoDeportista/inicio'],        
        'Actualizar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['EstadoDeportista/inicio'],
            'Crear' => ['EstadoDeportista/crear'],
        ]
    ];    
?>
<div class="col-sm-12">
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo]); ?>
</div>
