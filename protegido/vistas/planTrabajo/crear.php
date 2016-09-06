<?php 
    $this->tituloPagina = "Registrar plan de trabajo";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Planes de trabajo' => ['PlanTrabajo/inicio'],        
        'Crear'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['PlanTrabajo/inicio'],
        ]
    ];    
?>
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'objetivos' => $objetivos]); ?>
</div>
