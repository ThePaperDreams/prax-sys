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
<div class="col-sm-8">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'url' => $url]); ?>
</div>
