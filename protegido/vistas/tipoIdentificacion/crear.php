<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar TiposIdentificacion' => ['TipoIdentificacion/inicio'],        
        'Crear'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['TipoIdentificacion/inicio'],
        ]
    ];    
?>
<div class="col-sm-12">
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo]); ?>
</div>
