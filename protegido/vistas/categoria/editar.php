<?php 
$this->tituloPagina = "Actualizar categoría";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Categorías' => ['Categoria/inicio'],
        'Actualizar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Categoria/inicio'],
            'Registrar' => ['Categoria/crear'],
        ]
    ];    
?>
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'url' => $url, 'entrenadores' => $entrenadores]); ?>
</div>
