<?php 
    $this->tituloPagina = "Actualizar objetivos";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Objetivos' => ['Objetivo/inicio'],        
        'Actualizar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Objetivo/inicio'],
            'Crear' => ['Objetivo/crear'],
        ]
    ];    
?>
<div class="col-sm-10">
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'url' => $url]); ?>
</div>
