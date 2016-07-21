<?php
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar Deportistas' => ['Deportista/inicio'],
    'Actualizar'
];

$this->opciones = [
    'elementos' => [
        'Listar' => ['Deportista/inicio'],
        'Crear' => ['Deportista/crear'],
    ]
];
?>
<div class="col-sm-12">
    <?php echo $this->mostrarVistaP('_formulario', ['modelo' => $modelo, 'modelo2' => $modelo2, 'modelo3' => $modelo3, 'tiposIdentificaciones' => $tiposIdentificaciones, 'acudientes' => $acudientes, 'tiposDocumentos' => $tiposDocumentos]); ?>
</div>
<script>
    var a = [];
    var d = [];
<?php foreach ($modelo->getAcudientes() as $k => $v): ?>
        a.push(<?= $v->id_acudiente; ?>);
<?php endforeach; ?>
<?php foreach ($modelo->getDocumentos() as $k => $v): ?>
        d.push(<?= $v->tipo_id; ?>);
<?php endforeach; ?>
    $(function () {
        if (a.length > 0) {
            for (var i = 0; i < a.length; i++) {
                $("#Acudientes_id_acudiente option").each(function () {
                    if (parseInt($(this).val()) === a[i]) {
                        $(this).attr("disabled", "true");
                        return false;
                        /* return false; = break; return true; or return; = continue; */
                    }
                });
            }
        }
        if (d.length > 0) {
            for (var i = 0; i < d.length; i++) {
                $("#TiposDocumento_id_tipo option").each(function () {
                    if (parseInt($(this).val()) === d[i]) {
                        $(this).attr("disabled", "true");
                        return false;
                        /* return false; = break; return true; or return; = continue; */
                    }
                });
            }
        }
    });
</script>    