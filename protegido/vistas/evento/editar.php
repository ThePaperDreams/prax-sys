<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Eventos' => ['Evento/inicio'],        
        'Actualizar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Evento/inicio'],
            'Registrar' => ['Evento/crear'],
        ]
    ];    
?>
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo,
        'TipoEvento' => $TipoEvento,
        'Estado' => $Estado,
        'Autor' => $Autor,
        'url' => $url,
        'imagenes' => $imagenes
        ]); ?>
</div>
