<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar PlanesTrabajo' => ['PlanTrabajo/inicio'],        
        'Crear'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['PlanTrabajo/inicio'],
        ]
    ];    
?>
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo]); ?>
</div>
