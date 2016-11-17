<?php 
$formulario = new CBForm(['id' => 'form-estadodeportistas']);
$formulario->abrir();
?>
<div class="tile p-15">
<p>Los campos con <span class="text-danger">*</span>  son requeridos</p>
<?php echo $formulario->campoTexto($modelo, 'nombre', ['label' => true, 'group' => true, 'autofocus' => true, 'maxlength' => 45]) ?>
<div class="form-group">
    <label for="">Descripción <span id="total-chars">0</span>/<span id="max-chars">500</span> </label>
    <?php echo $formulario->areaTexto($modelo, 'descripcion', ['rows' => 8]) ?>
</div>

<!-- <?php echo $formulario->campoTexto($modelo, 'icono', ['label' => true, 'group' => true]) ?> -->

<!-- <?php echo $formulario->campoTexto($modelo, 'etiqueta', ['label' => true, 'group' => true]) ?> -->

<div class="row">
    <div class="col-sm-offset-6 col-sm-3">
        <?php echo CHtml::link(CBoot::fa('undo').' Cancelar', ['estadoDeportista/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
    </div>
    <div class="col-sm-3">
        <?php echo CBoot::boton(CBoot::fa('save') .' '. ($modelo->nuevo? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block']); ?>
    </div>
</div>
</div>

<?php $formulario->cerrar(); ?>

<script>
    $(function () {
        $("#EstadoDeportistas_descripcion").keydown(function(e){
            var t = $(this);
            var max = parseInt($("#max-chars").html());
            $("#total-chars").html(t.val().length);
            if(t.val().length >= max && ( e.which != 8 && e.which !== 116)){
                e.preventDefault();
                return false;
            }
        });
        $("#form-estadodeportistas").submit(function () {
            validarNombre();
            return false;
        });
    });
    function validarNombre() {
            var nombre = $("#EstadoDeportistas_nombre").val();                        
            if (nombre === "") {
                return;
            }
            $.ajax({
                type: 'POST',
                url: '<?php echo $url ?>',
                data: {
                    validarNombre: true,
                    nombre: $.trim(nombre),
                },
                success: function (respuesta) {
                    if (respuesta.error === true) {
                        mostrarAlert("error", "Ya existe ese Nombre");
                    } else {
                        document.getElementById("form-estadodeportistas").submit();
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