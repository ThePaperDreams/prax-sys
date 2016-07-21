<?php
$formulario = new CBForm(['id' => 'form-acudientes']);
$formulario->abrir();
?>
<p>Los campos con <span class="text-danger">*</span>  son requeridos</p>
<hr>
<div class="row">
    <div class="col-sm-6">
        <?php echo $formulario->lista($modelo, 'tipo_doc_id', $tiposIdentificaciones, ['label' => true, 'group' => true, 'defecto' => 'Tipo de documento']) ?>
    </div>
    <div class="col-sm-6">
        <?php echo $formulario->campoNumber($modelo, 'identificacion', ['label' => true, 'group' => true, 'autofocus' => true, 'min' => '0']) ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <?php echo $formulario->campoTexto($modelo, 'nombre1', ['label' => true, 'group' => true]) ?>
    </div>
    <div class="col-sm-6">
        <?php echo $formulario->campoTexto($modelo, 'nombre2', ['label' => true, 'group' => true]) ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <?php echo $formulario->campoTexto($modelo, 'apellido1', ['label' => true, 'group' => true]) ?>
    </div>
    <div class="col-sm-6">
        <?php echo $formulario->campoTexto($modelo, 'apellido2', ['label' => true, 'group' => true]) ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <?php echo $formulario->campoNumber($modelo, 'telefono1', ['label' => true, 'group' => true, 'min' => '0']) ?>
    </div>
    <div class="col-sm-6">
        <?php echo $formulario->campoNumber($modelo, 'telefono2', ['label' => true, 'group' => true, 'min' => '0']) ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <?php echo $formulario->campoTexto($modelo, 'direccion', ['label' => true, 'group' => true]) ?>
    </div>
    <div class="col-sm-6">
        <?php echo $formulario->campoTexto($modelo, 'email', ['label' => true, 'group' => true]) ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-8">
        <?php echo $formulario->lista($modelo2, 'id_tipo', $tiposDocumentos, ['label' => true, 'group' => true, 'defecto' => 'Seleccione un Tipo Documento']) ?>
    </div>
    <div class="col-sm-4">
        <?php echo CBoot::boton('Agregar Documento ' . CBoot::fa('file-word-o'), 'default', ['label' => true, 'group' => true, 'type' => 'button', 'class' => 'abajo', 'id' => 'btn-addDoc']) ?>
    </div>
</div>

<div id="lst-doc" class="panel panel-default">
    <div class="panel-heading">Documentos</div>
    <ul id="lis-doc" class="list-group">
    </ul>
</div>

<div class="row">
    <div class="col-sm-offset-6 col-sm-3">
        <?php echo CHtml::link(CBoot::fa('undo') . ' Cancelar', ['acudiente/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
    </div>
    <div class="col-sm-3">
        <?php echo CBoot::boton(CBoot::fa('save') . ' ' . ($modelo->nuevo ? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block']); ?>
    </div>
</div>

<script>
    $(function () {
        $("#btn-addDoc").click(function () {
            var m = $("#TiposDocumento_id_tipo option:selected");
            if (m.html() !== "Seleccione un Tipo Documento") {                
                $("#lis-doc").append("<li class='list-group-item' d='" +m.val()+ "'><button onclick='borrar(this)' type='button'><i class='text-danger fa fa-trash'></i></button> "+m.html()+"<input type='file' name='Documentos[]'></li>");
                m.attr("disabled", "true");
                $("#form-acudientes").append("<input hidden='' name='TiposDocumentos[]' id='td" + m.val() + "' value='" + m.val() + "'>");
            }
            $("#TiposDocumento_id_tipo").val('').attr("selected", "selected");
        });
        $("#form-acudientes").attr('enctype','multipart/form-data');
    });
    function borrar(e) {
        var d = $(e).closest('li').attr('d');
        $("#TiposDocumento_id_tipo option:disabled").each(function (index) {
            if ($(this).val() === d) {
                $(this).removeAttr("disabled");
            }
        });
        $(e).closest('li').remove();
        $("#td" + d).remove();
    }
</script>

<?php $formulario->cerrar(); ?>

