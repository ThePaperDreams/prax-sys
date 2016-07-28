<?php
$this->tituloPagina = "Actualizar Deportista";
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar Deportistas' => ['Deportista/inicio'],
    'Actualizar'
];

$this->opciones = [
    'elementos' => [
        'Listar' => ['Deportista/inicio'],
        'Registrar' => ['Deportista/crear'],
    ]
];
?>
<div class="col-sm-12">
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'modelo2' => $modelo2, 'modelo3' => $modelo3, 'tiposIdentificaciones' => $tiposIdentificaciones, 'acudientes' => $acudientes, 'tiposDocumentos' => $tiposDocumentos, 'estados' => $estados]); ?>
</div>    