<?php 
echo "<?php \n";
?>
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar <?= $nTabla ?>' => ['<?= $nModelo ?>/inicio'],        
        'Actualizar'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['<?= $nModelo ?>/inicio'],
            'Crear' => ['<?= $nModelo ?>/crear'],
        ]
    ];    
?>
<div class="col-sm-8">    
    <?php echo "<?php echo \$this->mostrarVistaP('_formulario', ['modelo' => \$modelo]); ?>\n"; ?>
</div>
