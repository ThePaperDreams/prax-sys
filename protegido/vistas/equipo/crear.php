<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Equipos' => ['Equipo/inicio'],        
        'Registrar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Equipo/inicio'],
        ]
    ];    
?>
<div class="col-sm-8">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'Entre' => $Entre, 'deportista' => $deportista, 'deportistas' => $deportistas, 'mTorneo' => $mTorneo,'url'=>$url]); ?>
</div>
