<?php 
    $this->tituloPagina = "Actualizar Módulo";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Modulos' => ['Modulo/inicio'],        
        'Actualizar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Modulo/inicio'],
            'Registrar' => ['Modulo/crear'],
        ]
    ];    
?>
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo]); ?>
</div>
