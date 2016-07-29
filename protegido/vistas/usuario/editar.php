<?php 
    $this->tituloPagina = "Editar Usuario";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Usuarios' => ['Usuario/inicio'],        
        'Editar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Usuario/inicio'],
            'Registrar' => ['Usuario/crear'],
        ]
    ];    
?>
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'roles'=>$roles]); ?>
</div>
