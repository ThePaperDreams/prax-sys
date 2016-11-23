<?php 
    $this->tituloPagina = "Registar Usuario";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Usuarios' => ['Usuario/inicio'],        
        'Registrar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Usuario/inicio'],
        ]
    ];    
?>
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'roles' => $roles, 'url' => $url, 'tiposIdentificacion' => $tiposIdentificacion]); ?>
</div>
