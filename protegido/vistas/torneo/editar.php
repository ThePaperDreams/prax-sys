<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Torneos' => ['Torneo/inicio'],        
        'Actualizar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Torneo/inicio'],
            'Crear' => ['Torneo/crear'],
        ]
    ];    
?>
<div class="col-sm-8">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'mEquipo' => $mEquipo]); ?>
</div>
