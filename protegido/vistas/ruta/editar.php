<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Rutas' => ['Ruta/inicio'],        
        'Actualizar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Ruta/inicio'],
            'Crear' => ['Ruta/crear'],
        ]
    ];    
?>
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo]); ?>
</div>
