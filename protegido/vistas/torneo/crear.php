<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Torneos' => ['Torneo/inicio'],        
        'Crear'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Torneo/inicio'],
        ]
    ];    
?>
<div class="col-sm-12">
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo]); ?>
</div>
