<?php
$this->tituloPagina = "Registrar Deportista";
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar Deportistas' => ['Deportista/inicio'],
    'Registrar'
];

$this->opciones = [
    'elementos' => [
        'Listar' => ['Deportista/inicio'],
    ]
];
?>
<div class="col-sm-12">
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'modelo2' => $modelo2, 'modelo3' => $modelo3, 'tiposIdentificaciones' => $tiposIdentificaciones, 'acudientes' => $acudientes, 'tiposDocumentos' => $tiposDocumentos, 'estados' => $estados, 'url' => $url, 'url2' => 'vacio']); ?>
</div>