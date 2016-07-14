<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Implementos' => ['Implemento/inicio'],        
        'Crear'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Implemento/inicio'],
        ]
    ];    
?>
<div class="col-sm-8">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'elementos' => $elementos]); ?>
</div>
