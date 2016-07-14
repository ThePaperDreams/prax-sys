<?php 
$columnas = $modelo->etiquetasAtributos();
$pk = $modelo->getPk();
echo "<?php \n";
?>
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar <?= $nTabla ?>' => ['<?= $nModelo ?>/inicio'],        
        'Ver'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['<?= $nModelo ?>/inicio'],
            'Crear' => ['<?= $nModelo ?>/crear'],
            'Modificar' => ['<?= $nModelo ?>/editar', 'id' => $modelo-><?= $pk ?>],
        ]
    ];
?>
<div class="col-sm-8">
    <div class="panel panel-primary">
        <div class="panel-heading text-center">
            Ver detalles
        </div>
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <?php foreach ($columnas AS $col=>$et): ?>
                <tr>
                    <th><?php echo "<?php echo \$modelo->obtenerEtiqueta('$col') ?>"; ?></th>
                    <td><?php echo "<?php echo \$modelo->$col; ?>"?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>
