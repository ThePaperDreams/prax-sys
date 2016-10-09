<?php
$this->tituloPagina = "Editar Acudiente";
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar Acudientes' => ['Acudiente/inicio'],
    'Actualizar'
];

$this->opciones = [
    'elementos' => [
        'Listar' => ['Acudiente/inicio'],
        'Registrar' => ['Acudiente/crear'],
    ]
];
?>
<div class="col-sm-12">
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'modelo2' => $modelo2, 'tiposDocumentos'=>$tiposDocumentos, 'tiposIdentificaciones' => $tiposIdentificaciones, 'url'=>$url, 'url2' => $url2]); ?>
</div>