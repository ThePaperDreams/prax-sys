<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Publicaciones' => ['Publicacion/inicio'],        
        'Crear'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Publicacion/inicio'],
        ]
    ];    
?>
<div class="col-sm-8">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'public' => $public, 'estd' => $estd, 'url'=>$url]); ?>
</div>
