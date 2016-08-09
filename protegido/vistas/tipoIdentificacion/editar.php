<?php 
    $this->tituloPagina = "Editar Tipo de Identificación";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Tipos de Identificación' => ['TipoIdentificacion/inicio'],        
        'Editar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['TipoIdentificacion/inicio'],
            'Registrar' => ['TipoIdentificacion/crear'],
        ]
    ];    
?>
<div class="col-sm-12">
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'url' => $url]); ?>
</div>
