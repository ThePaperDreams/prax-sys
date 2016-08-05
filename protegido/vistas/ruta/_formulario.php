<?php 
$formulario = new CBForm(['id' => 'form-rutas']);
$formulario->abrir();
?>
<div class="tile p-15">
<p>Los campos con <span class="text-danger">*</span>  son requeridos</p>
<?php echo $formulario->campoTexto($modelo, 'nombre', ['label' => true, 'group' => true, 'autofocus' => true]) ?>
<?php echo $formulario->campoTexto($modelo, 'ruta', ['label' => true, 'group' => true]) ?>
<?php echo $formulario->lista($modelo, 'modulo_id', $modulos, ['label' => true, 'group' => true, 'defecto' => '']) ?>

<div class="row">
    <div class="col-sm-offset-6 col-sm-3">
        <?php echo CHtml::link(CBoot::fa('undo').' Cancelar', ['ruta/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
    </div>
    <div class="col-sm-3">
        <?php echo CBoot::boton(CBoot::fa('save') .' '. ($modelo->nuevo? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block']); ?>
    </div>
</div>
</div>
<?php $formulario->cerrar(); ?>
<script>
    $(function () {
        $("#form-rutas").submit(function () {
            validarNombreRuta();
            return false;
        });
    });
    function validarNombreRuta() {
            var nombre = $("#Rutas_nombre").val();
            var ruta = $("#Rutas_ruta").val();
            if (nombre === "" || ruta === "") {
                return;
            }
            $.ajax({
                type: 'POST',
                url: '<?php echo $url ?>',
                data: {
                    validarNombreRuta: true,
                    ruta: ruta,
                    nombre: nombre,
                },
                success: function (respuesta) {
                    if (respuesta.error === true) {
                        mostrarAlert("error", "Ya existe ese Nombre o Ruta");
                    } else {
                        document.getElementById("form-rutas").submit();
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
</script>