<?php 
$columnas = $modelo->etiquetasAtributos();
$atributos = array_slice(array_keys($columnas), 0, 4);
$attrs = array_keys($columnas);
$pk = $modelo->getPk();
echo "<?php \n";
?>
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar <?= $nTabla ?>'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Crear' => ['<?= $nModelo ?>/crear'],
        ]
    ];
?>

<?= "<?= \$this->complemento('!siscoms.bootstrap3.CBGrid', [\n" ?>
    'modelo' => '<?= $nModelo ?>',
    # <?= implode(', ', $attrs) . "\n" ?>
    'columnas' => '<?= implode(', ', $atributos) ?>',
    'opciones' => true,
    'paginacion' => 10,
]) ?>