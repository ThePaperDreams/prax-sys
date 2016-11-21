<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar TiposEvento' => ['TipoEvento/inicio'],        
        'Registrar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['TipoEvento/inicio'],
        ]
    ];    
?>
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'url' => $url]); ?>
</div>
