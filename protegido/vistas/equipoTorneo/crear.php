<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar EquiposTorneos' => ['EquipoTorneo/inicio'],        
        'Crear'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['EquipoTorneo/inicio'],
        ]
    ];    
?>
<div class="col-sm-8">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo]); ?>
</div>
