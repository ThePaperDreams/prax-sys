<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar TiposEvento' => ['TipoEvento/inicio'],        
        'Actualizar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['TipoEvento/inicio'],
            'Crear' => ['TipoEvento/crear'],
        ]
    ];    
?>
<div class="col-sm-8">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo]); ?>
</div>
