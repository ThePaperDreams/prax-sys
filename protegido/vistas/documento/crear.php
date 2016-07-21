<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Documentos' => ['Documento/inicio'],        
        'Crear'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Documento/inicio'],
        ]
    ];    
?>
<div class="col-sm-12">
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'tiposDocumentos' => $tiposDocumentos]); ?>
</div>
