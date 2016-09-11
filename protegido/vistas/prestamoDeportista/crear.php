<?php 
    $this->tituloPagina = "Prestar deportista";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar PrestamosDeportista' => ['PrestamoDeportista/inicio'],        
        'Crear'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['PrestamoDeportista/inicio'],
        ]
    ];    
?>
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'deportistas' => $deportistas, 'entrada' => $entrada]); ?>
</div>
