<?php
$this->tituloPagina = "Registrar un Acudiente";
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar Acudientes' => ['Acudiente/inicio'],
    'Crear'
];

$this->opciones = [
    'elementos' => [
        'Listar' => ['Acudiente/inicio'],
    ]
];
?>
<div class="col-sm-12">
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'modelo2' => $modelo2, 'tiposIdentificaciones' => $tiposIdentificaciones, 'tiposDocumentos' => $tiposDocumentos]); ?>
</div>
