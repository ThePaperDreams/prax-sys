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
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo,'elementos'=>$elementos, 'url' => $url]); ?>
</div>
