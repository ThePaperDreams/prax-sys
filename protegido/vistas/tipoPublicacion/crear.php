<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar TiposPublicacion' => ['TipoPublicacion/inicio'],        
        'Crear'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['TipoPublicacion/inicio'],
        ]
    ];    
?>
<div class="col-sm-8">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo]); ?>
</div>
