<?php 
$this->ayuda = "categoria/crear";
$this->ayudaTitulo = "Crear categoría de deportista";
$this->tituloPagina = "Registrar categoría";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Categorías' => ['Categoria/inicio'],        
        'Crear'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Categoria/inicio'],
        ]
    ];    
?>
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'url' => $url, 'entrenadores' => $entrenadores]); ?>
</div>
