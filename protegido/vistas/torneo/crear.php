<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Torneos' => ['Torneo/inicio'],        
        'Registrar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Torneo/inicio'],
        ]
    ];    
    $this->tituloPagina = "Registrar torneo";
?>
<div class="col-sm-12">
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo]); ?>
</div>
