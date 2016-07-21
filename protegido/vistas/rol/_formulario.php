<?php 
$formulario = new CBForm(['id' => 'form-roles']);
$formulario->abrir();
?>
<?php echo $formulario->campoTexto($modelo, 'nombre', ['label' => true, 'group' => true, 'autofocus' => true]) ?>
<?php echo $formulario->areaTexto($modelo, 'descripcion', ['label' => true, 'group' => true]) ?>

<div class="row">
    <div class="col-sm-9">
        <?php echo $formulario->lista($modelo2, 'id_ruta', $rutas, ['label' => true, 'group' => true, 'autofocus' => true, 'defecto'=>'Seleccione una Ruta']) ?>
    </div>
    <div class="col-sm-3">
        <?php echo CBoot::boton('Agregar Ruta ' . CBoot::fa('location-arrow'), 'default', ['label' => true, 'group' => true, 'type' => 'button', 'class' => 'abajo', 'id' => 'btn-addRut']) ?>
    </div>
</div>

<div id="lst-rut" class="panel panel-default">
    <div class="panel-heading">Rutas</div>
    <ul id="lis-rut" class="list-group">
    </ul>
</div>

<div class="row">
    <div class="col-sm-offset-6 col-sm-3">
        <?php echo CHtml::link(CBoot::fa('undo').' Cancelar', ['rol/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
    </div>
    <div class="col-sm-3">
        <?php echo CBoot::boton(CBoot::fa('save') .' '. ($modelo->nuevo? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block']); ?>
    </div>
</div>

<script>
    $(function () {
        $("#btn-addRut").click(function () {
            var m = $("#Rutas_id_ruta option:selected");
            if (m.html() !== "Seleccione una Ruta") {                
                $("#lis-rut").append("<li class='list-group-item' d='" +m.val()+ "'><button onclick='borrar(this)' type='button'><i class='text-danger fa fa-trash'></i></button> "+m.html()+"</li>");
                m.attr("disabled", "true");
                $("#form-roles").append("<input hidden='' name='Rutas[]' id='" + m.val() + "' value='" + m.val() + "'>");
            }
            $("#Rutas_id_ruta").val('').attr("selected", "selected");
        });
    });
    function borrar(e) {
        var d = $(e).closest('li').attr('d');
        $("#Rutas_id_ruta option:disabled").each(function (index) {
            if ($(this).val() === d) {
                $(this).removeAttr("disabled");
            }
        });
        $(e).closest('li').remove();
        $("#" + d).remove();
    }
</script>

<?php $formulario->cerrar(); ?>