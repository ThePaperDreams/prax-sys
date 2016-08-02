<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Pagos' => ['Pago/inicio'],        
        'Crear'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Pago/inicio'],
        ]
    ];    
?>
<div class="col-sm-8">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo]); ?>
</div>
