<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Entradas' => ['Entrada/inicio'],        
        'Actualizar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Entrada/inicio'],
            'Registrar' => ['Entrada/crear'],
        ]
    ];    
?>
<div class="col-sm-8">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo]); ?>
</div>
