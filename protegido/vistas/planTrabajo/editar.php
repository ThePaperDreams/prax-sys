<?php 
    $this->tituloPagina = "Actualizar plan de trabajo";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Plan de Trabajo' => ['PlanTrabajo/inicio'],        
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
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'objetivos' => $objetivos]); ?>
</div>
