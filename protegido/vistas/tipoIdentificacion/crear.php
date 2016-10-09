<?php 
    $this->tituloPagina = "Registrar Tipo de Identificación";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Tipos de Identificación' => ['TipoIdentificacion/inicio'],        
        'Registrar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['TipoIdentificacion/inicio'],
        ]
    ];    
?>
<div class="col-sm-12">
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'url' => $url]); ?>
</div>
