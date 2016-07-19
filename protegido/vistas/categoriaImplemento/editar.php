<?php 
$this->tituloPagina="Actualizar categoría implementos";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar categoría de implemento' => ['CategoriaImplemento/inicio'],        
        'Actualizar categoría implemeto'
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
