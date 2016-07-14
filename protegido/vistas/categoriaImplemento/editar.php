<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar CategoriasImplementos' => ['CategoriaImplemento/inicio'],        
        'Actualizar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['CategoriaImplemento/inicio'],
            'Crear' => ['CategoriaImplemento/crear'],
        ]
    ];    
?>
<div class="col-sm-8">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo]); ?>
</div>
