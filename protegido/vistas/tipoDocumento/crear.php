<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar TiposDocumento' => ['TipoDocumento/inicio'],        
        'Crear'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['TipoDocumento/inicio'],
        ]
    ];    
?>
<div class="col-sm-12">
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'tiposDocumentos' => $tiposDocumentos]); ?>
</div>
