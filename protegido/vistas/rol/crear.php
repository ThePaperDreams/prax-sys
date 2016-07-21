<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Roles' => ['Rol/inicio'],        
        'Crear'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Rol/inicio'],
        ]
    ];    
?>
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'modelo2'=>$modelo2, 'rutas'=>$rutas]); ?>
</div>
