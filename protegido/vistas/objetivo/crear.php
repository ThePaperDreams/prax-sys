<?php 
    $this->tituloPagina = "Registrar objetivo";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Objetivos' => ['Objetivo/inicio'],        
        'Registrar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Objetivo/inicio'],
        ]
    ];    
?>
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'url' => $url]); ?>
</div>
