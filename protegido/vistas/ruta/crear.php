<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Rutas' => ['Ruta/inicio'],        
        'Crear'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Ruta/inicio'],
        ]
    ];    
?>
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo]); ?>
</div>
