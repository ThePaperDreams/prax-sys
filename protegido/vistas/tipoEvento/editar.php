<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar TiposEvento' => ['TipoEvento/inicio'],        
        'Actualizar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['TipoEvento/inicio'],
            'Registrar' => ['TipoEvento/crear'],
        ]
    ];    
?>
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'url' => $url]); ?>
</div>
