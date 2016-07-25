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
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'modelo2' => $modelo2, 'tiposDocumentos'=>$tiposDocumentos, 'tiposIdentificaciones' => $tiposIdentificaciones]); ?>
</div>
<!--<script>
    var d = [];
<?php# foreach ($modelo->getDocumentos() as $k => $v): ?>
        d.push(<?php# echo $v->tipo_id; ?>);
<?php# endforeach; ?>
    $(function () {
        if (d.length > 0) {
            for (var i = 0; i < d.length; i++) {
                $("#TiposDocumento_id_tipo option").each(function () {
                    if (parseInt($(this).val()) === d[i]) {
                        $(this).attr("disabled", "true");
                        return false;
                    }
                });
            }
        }
    });
</script>-->