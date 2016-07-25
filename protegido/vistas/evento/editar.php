<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Eventos' => ['Evento/inicio'],        
        'Actualizar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Evento/inicio'],
            'Crear' => ['Evento/crear'],
        ]
    ];    
?>
<div class="col-sm-8">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo]); ?>
</div>
