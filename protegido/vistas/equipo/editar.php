<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Equipos' => ['Equipo/inicio'],        
        'Actualizar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Equipo/inicio'],
            'Crear' => ['Equipo/crear'],
        ]
    ];    
?>
<div class="col-sm-8">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'Entre' => $Entre, 'deportista' => $deportista, 'deportistas' => $deportistas,'mTorneo' => $mTorneo,'mTorneo' => $mTorneo, 'url'=>$url]); ?>
</div>
