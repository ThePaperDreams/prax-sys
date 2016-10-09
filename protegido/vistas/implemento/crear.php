<?php 
$this->tituloPagina="Registrar implemento";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Implementos' => ['Implemento/inicio'],        
        'Registrar implemento'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Implemento/inicio'],
        ]
    ];    
?>
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'elementos' => $elementos, 'url' => $url]); ?>
</div>
