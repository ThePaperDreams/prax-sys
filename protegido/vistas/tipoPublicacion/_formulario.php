<?php 

$formulario = new CBForm(['id' => 'form-tipospublicacion']);
$formulario->abrir();
?>
<div class="tile p-15">
    <?php echo $formulario->inputAddon($modelo, 'nombre', 'texto', ['label' => true, 'group' => true, 'autofocus' => true], 'font') ?>
    <?php echo $formulario->areaTexto($modelo, 'descripcion', ['label' => true, 'group' => true]) ?>
    <div class="row">
        <div class="col-sm-offset-6 col-sm-3">
            <?php echo CHtml::link(CBoot::fa('undo').' Cancelar', ['tipoPublicacion/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
        </div>
        <div class="col-sm-3">
            <?php echo CBoot::boton(CBoot::fa('save') .' '. ($modelo->nuevo? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block']); ?>
        </div>
    </div>
</div>
<?php $formulario->cerrar(); ?>

<script>
 $(function(){
        $("#form-tipospublicacion").submit(function(){
            validarNombre();
            return false;
        });
    });  
    
    function validarNombre() {
        var nombre = $("#TiposPublicacion_nombre").val();
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
                    document.getElementById("form-tipospublicacion").submit();
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