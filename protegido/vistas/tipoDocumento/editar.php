<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar TiposDocumento' => ['TipoDocumento/inicio'],        
        'Actualizar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['TipoDocumento/inicio'],
            'Crear' => ['TipoDocumento/crear'],
        ]
    ];    
?>
<div class="col-sm-12">
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'tiposDocumentos' => $tiposDocumentos]); ?>
</div>
