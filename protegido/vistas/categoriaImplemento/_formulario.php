<?php
$formulario = new CBForm(['id' => 'form-categoriasimplementos']);
$formulario->abrir();
?>
<div class="tile p-15">
    <?php echo $formulario->campoTexto($modelo, 'nombre', ['label' => true, 'group' => true, 'autofocus' => true]) ?>
    <?php echo $formulario->areaTexto($modelo, 'descripcion', ['label' => true, 'group' => true]) ?>

    <div class="row">
        <div class="col-sm-offset-6 col-sm-3">
            <?php echo CHtml::link(CBoot::fa('undo') . ' Cancelar', ['categoriaImplemento/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
        </div>
        <div class="col-sm-3">
            <?php echo CBoot::boton(CBoot::fa('save') . ' ' . ($modelo->nuevo ? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block']); ?>
        </div>
    </div>

<?php $formulario->cerrar(); ?>
    </div>
<script>
    $(function () {
        $("#form-categoriasimplementos").submit(function () {
            validarNombre();
            return false;
        });

        function validarNombre() {
            var nombre = $("#CategoriasImplementos_nombre").val();
            if (nombre === "") {
                return;
            }

            $.ajax({
                type: 'POST',
                url: '<?= $url ?>',
                data: {
                    validarNombre: true,
                    nombre: nombre,
                },
                success: function (respuesta) {
                    if (respuesta.error == true) {
                        mostrarAlert("error", "Ya existe ese nombre");
                    } else {
                        document.getElementById("form-categoriasimplementos").submit();
                    }
                }
            });
        }

        function mostrarAlert(tipo, msg) {
            Lobibox.notify(tipo, {
                size: 'mini',
                showClass: 'bounceInRight',
                hideClass: 'bounceOutRight',
                msg: msg,
                delay: 8000,
                soundPath: '<?= Sis::UrlRecursos() ?>librerias/lobibox/sounds/',
            });
        }

    });
</script>
