<?php
$this->tituloPagina = "Registrar Acudiente";
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar Acudientes' => ['Acudiente/inicio'],
    'Registrar'
];

$this->opciones = [
    'elementos' => [
        'Listar' => ['Acudiente/inicio'],
    ]
];
?>
<div class="col-sm-12">
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'modelo2' => $modelo2, 'tiposIdentificaciones' => $tiposIdentificaciones, 'tiposDocumentos' => $tiposDocumentos, 'url' => $url, 'url2' => 'vacio']); ?>
</div>
