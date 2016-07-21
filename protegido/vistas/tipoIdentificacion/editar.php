<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar TiposIdentificacion' => ['TipoIdentificacion/inicio'],        
        'Actualizar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['TipoIdentificacion/inicio'],
            'Crear' => ['TipoIdentificacion/crear'],
        ]
    ];    
?>
<div class="col-sm-12">
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo]); ?>
</div>
