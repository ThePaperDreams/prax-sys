<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Salidas' => ['Salida/inicio'],        
        'Crear'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Salida/inicio'],
        ]
    ];    
?>
<div class="col-sm-8">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo,'usuarios' => $usuarios]); ?>
</div>
