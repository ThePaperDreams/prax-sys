<?php 
    $this->tituloPagina = "Actualizar Usuario";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Usuarios' => ['Usuario/inicio'],        
        'Actualizar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Usuario/inicio'],
            'Registrar' => ['Usuario/crear'],
        ]
    ];    
?>
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'roles' => $roles, 'url' => $url, 'tiposIdentificacion' => $tiposIdentificacion]); ?>
</div>
