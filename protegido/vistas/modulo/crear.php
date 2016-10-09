<?php 
    $this->tituloPagina = "Registrar Módulo";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Modulos' => ['Modulo/inicio'],        
        'Registrar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Modulo/inicio'],
        ]
    ];    
?>
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo]); ?>
</div>
