<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar CategoriaImplementos' => ['CategoriaImplemento/inicio'],        
        'Crear'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['CategoriaImplemento/inicio'],
        ]
    ];    
?>
<div class="col-sm-8">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo]); ?>
</div>
