<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Configuraciones' => ['principal/configuracion'],        
        'Listar EstadosPublicacion' => ['EstadoPublicacion/inicio'],        
        'Registrar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['EstadoPublicacion/inicio'],
        ]
    ];    
    $this->tituloPagina = "Registrar Estado de publicación";
?>
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo]); ?>
</div>