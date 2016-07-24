<?php 
$this->tituloPagina="Actualizar implementos";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Implementos' => ['Implemento/inicio'],        
        'Actualizar implementos'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Implemento/inicio'],
            'Crear' => ['Implemento/crear'],
        ]
    ];    
?>
<div class="col-sm-8">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'url' => $url]); ?>
</div>
