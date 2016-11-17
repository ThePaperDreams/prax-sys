<?php 
    $this->tituloPagina = "Editar Estado de Deportista";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Configuraciones' => ['principal/configuracion'],
        'Listar Estados de Deportistas' => ['EstadoDeportista/inicio'],        
        'Editar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['EstadoDeportista/inicio'],
            'Registrar' => ['EstadoDeportista/crear'],
        ]
    ];    
?>
<div class="col-sm-12">
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'url' => $url]); ?>
</div>
