<?php 
    $this->tituloPagina = "Modificar Préstamo";
    
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar PrestamosDeportista' => ['PrestamoDeportista/inicio'],        
        'Actualizar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['PrestamoDeportista/inicio'],
            'Crear' => ['PrestamoDeportista/crear'],
        ]
    ];    
?>
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'deportistas' => $deportistas, 'entrada' => $entrada]); ?>
</div>
