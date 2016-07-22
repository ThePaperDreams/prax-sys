<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar EquiposTorneos' => ['EquipoTorneo/inicio'],        
        'Actualizar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['EquipoTorneo/inicio'],
            'Crear' => ['EquipoTorneo/crear'],
        ]
    ];    
?>
<div class="col-sm-8">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo]); ?>
</div>
