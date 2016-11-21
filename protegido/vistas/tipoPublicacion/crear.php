<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar TiposPublicacion' => ['TipoPublicacion/inicio'],        
        'Registrar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['TipoPublicacion/inicio'],
        ]
    ];    
?>
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'url' => $url]); ?>
</div>
