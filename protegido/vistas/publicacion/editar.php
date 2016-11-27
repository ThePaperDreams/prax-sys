<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Publicaciones' => ['Publicacion/inicio'],        
        'Actualizar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Publicacion/inicio'],
            'Registrar' => ['Publicacion/crear'],
        ]
    ];    
    $this->tituloPagina = "Actualizar publicación";
?>
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'public' => $public, 'estd' => $estd, 'url'=>$url, 'imagenes' => $imagenes]); ?>
</div>
