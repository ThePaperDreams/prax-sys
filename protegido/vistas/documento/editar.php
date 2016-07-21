<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Documentos' => ['Documento/inicio'],        
        'Actualizar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Documento/inicio'],
            'Crear' => ['Documento/crear'],
        ]
    ];    
?>
<div class="col-sm-12">
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'tiposDocumentos' => $tiposDocumentos]); ?>
</div>
