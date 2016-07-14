<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar PlanesTrabajo' => ['PlanTrabajo/inicio'],        
        'Actualizar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['PlanTrabajo/inicio'],
            'Crear' => ['PlanTrabajo/crear'],
        ]
    ];    
?>
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo]); ?>
</div>
