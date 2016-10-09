<?php 
$this->tituloPagina="Registrar categoría de implemento";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar categoría de implementos' => ['CategoriaImplemento/inicio'],        
        'Crear'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['CategoriaImplemento/inicio'],
        ]
    ];    
?>
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'url' => $url]); ?>
</div>
