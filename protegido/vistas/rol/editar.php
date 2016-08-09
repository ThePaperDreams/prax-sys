<?php 
    $this->tituloPagina = "Actualizar Rol";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Roles' => ['Rol/inicio'],        
        'Actualizar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Rol/inicio'],
            'Registrar' => ['Rol/crear'],
            'Asignar permisos' => ['Permiso/asignar'],
        ]
    ];    
?>
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'url' => $url]); ?>
</div>