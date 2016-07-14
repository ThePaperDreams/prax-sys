<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Categorias' => ['Categoria/inicio'],        
        'Crear'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Categoria/inicio'],
        ]
    ];    
?>
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'entrenadores' => $entrenadores]); ?>
</div>
