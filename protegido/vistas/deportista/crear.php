<?php
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar Deportistas' => ['Deportista/inicio'],
    'Crear'
];

$this->opciones = [
    'elementos' => [
        'Listar' => ['Deportista/inicio'],
    ]
];
?>
<div class="col-sm-12">
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'modelo2' => $modelo2, 'modelo3' => $modelo3, 'tiposIdentificaciones' => $tiposIdentificaciones, 'acudientes' => $acudientes, 'tiposDocumentos' => $tiposDocumentos]); ?>
</div>