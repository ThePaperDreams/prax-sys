<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar TiposPublicacion' => ['TipoPublicacion/inicio'],        
        'Actualizar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['TipoPublicacion/inicio'],
            'Registrar' => ['TipoPublicacion/crear'],
        ]
    ];    
?>
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'url' => $url]); ?>
</div>
