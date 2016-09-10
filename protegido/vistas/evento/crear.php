<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Eventos' => ['Evento/inicio'],        
        'Crear'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Evento/inicio'],
        ]
    ];    
?>
<div class="col-sm-8">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo,
        'TipoEvento' => $TipoEvento,
        'Estado' => $Estado,
        'Autor' => $Autor,
        'url' => $url,
        ]); ?>
</div>
