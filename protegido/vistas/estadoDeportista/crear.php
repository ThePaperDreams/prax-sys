<?php 
    $this->tituloPagina = "Registrar Estado de Deportista";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Configuraciones' => ['principal/configuracion'],
        'Listar Estados de Deportistas' => ['EstadoDeportista/inicio'],        
        'Registrar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['EstadoDeportista/inicio'],
        ]
    ];    
?>
<div class="col-sm-12">
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'url' => $url]); ?>
</div>
