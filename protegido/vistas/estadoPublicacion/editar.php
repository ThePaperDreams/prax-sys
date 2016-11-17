<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Configuraciones' => ['principal/configuracion'],        
        'Listar EstadosPublicacion' => ['EstadoPublicacion/inicio'],        
        'Actualizar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['EstadoPublicacion/inicio'],
            'Registrar' => ['EstadoPublicacion/crear'],
        ]
    ];    
    
    $this->tituloPagina = "Editar estado publicación";
?>
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo]); ?>
</div>
