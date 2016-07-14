<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Entradas' => ['Entrada/inicio'],        
        'Crear'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Entrada/inicio'],
        ]
    ];    
?>
<div class="col-sm-8">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo,'usuarios' => $usuarios]); ?>
</div>
