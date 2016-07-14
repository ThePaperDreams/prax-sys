<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Asistencia' => ['Asistencia/inicio'],        
        'Crear'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Asistencia/inicio'],
        ]
    ];    
?>
<div class="col-sm-12">
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo]); ?>
</div>
