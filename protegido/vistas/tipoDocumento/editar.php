<?php 
    $this->tituloPagina = "Editar Tipo de Documento";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Tipos de Documentos' => ['TipoDocumento/inicio'],        
        'Editar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['TipoDocumento/inicio'],
            'Registrar' => ['TipoDocumento/crear'],
        ]
    ];    
?>
<div class="col-sm-12">
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'tiposDocumentos' => $tiposDocumentos]); ?>
</div>
