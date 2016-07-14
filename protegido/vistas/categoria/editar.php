<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Categorias' => ['Categoria/inicio'],        
        'Actualizar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Categoria/inicio'],
            'Crear' => ['Categoria/crear'],
        ]
    ];    
?>
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'entrenadores' => $entrenadores]); ?>
</div>
