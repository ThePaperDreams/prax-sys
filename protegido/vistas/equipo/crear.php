<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Equipos' => ['Equipo/inicio'],        
        'Crear'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Equipo/inicio'],
        ]
    ];    
?>
<div class="col-sm-8">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'Entre' => $Entre, 'deportista' => $deportista]); ?>
</div>
