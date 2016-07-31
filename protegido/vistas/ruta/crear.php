<?php 
    $this->tituloPagina = "Registrar Ruta";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Rutas' => ['Ruta/inicio'],        
        'Registrar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Ruta/inicio'],
        ]
    ];    
?>
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'modulos'=>$modulos]); ?>
</div>
