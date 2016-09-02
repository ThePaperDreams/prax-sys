<?php 
$this->tituloPagina="Entrada de implementos";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar entrada de implementos' => ['Entrada/inicio'],        
        'Crear entrada'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Entrada/inicio'],
        ]
    ];    
?>
<div class="col-sm-12">    
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo,'usuarios' => $usuarios]); ?>
</div>
