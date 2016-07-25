<?php
    $this->tituloPagina = "Registrar Tipo de Documento";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Tipos de Documentos' => ['TipoDocumento/inicio'],        
        'Registrar'
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
