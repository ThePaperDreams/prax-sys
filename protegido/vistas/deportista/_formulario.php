<?php
$formulario = new CBForm(['id' => 'form-deportistas']);
$formulario->abrir();
?>

<div class="row">
    <div class="col-sm-6">
        <?php echo $formulario->lista($modelo, 'tipo_documento_id', $tiposIdentificaciones, ['label' => true, 'group' => true, 'defecto' => 'Tipo de documento']) ?>
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
        <?php echo $formulario->campoTexto($modelo, 'fecha_nacimiento', ['label' => true, 'group' => true, 'id' => 'birthday']) ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        <?php echo $formulario->lista($modelo2, 'id_acudiente', $acudientes, ['label' => true, 'group' => true, 'defecto' => 'Seleccione un Acudiente']) ?>
    </div>
    <div class="col-sm-2">
        <?php echo CBoot::boton(CBoot::fa('plus') . ' Agregar', 'default', ['label' => true, 'group' => true, 'type' => 'button', 'class' => 'abajo', 'id' => 'btn-addAcu']) ?>
    </div>
    <div class="col-sm-4">
        <?php echo $formulario->lista($modelo3, 'id_tipo', $tiposDocumentos, ['label' => true, 'group' => true, 'defecto' => 'Seleccione un Tipo Documento']) ?>
    </div>
    <div class="col-sm-2">
        <?php echo CBoot::boton(CBoot::fa('plus') . ' Agregar', 'default', ['label' => true, 'group' => true, 'type' => 'button', 'class' => 'abajo', 'id' => 'btn-addDoc']) ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div id="lst-acu" class="panel panel-default">
            <div class="panel-heading">Acudientes</div>
            <ul id="lis-acu" class="list-group">
            </ul>
        </div>
    </div>
    <div class="col-sm-6">
        <div id="lst-doc" class="panel panel-default">
            <div class="panel-heading">Documentos</div>
            <ul id="lis-doc" class="list-group">
            </ul>
        </div>
    </div>
</div>
<?php if (!$modelo->nuevo): ?>
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    Acudiente/s Asociado/s Actualmente
                </div>            
                <table class="table table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th>Acudiente</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody id="tabla-acudientes">
                        <?php foreach ($modelo->Acudiente AS $dc): ?>
                            <tr>

                                <td titulo="<?= $dc->Acudiente->datos ?>"><?= $dc->Acudiente->datos ?></td>            
                                <td class="col-sm-1 text-center text-danger-icon"><a class="delete" data-iddepacu="<?= $dc->id ?>" href="#"><i class="fa fa-ban"></i></a></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>      
        </div>    
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    Documento/s Asociado/s Actualmente
                </div>            
                <table class="table table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th>Documento</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody id="tabla-documentos">
                        <?php foreach ($modelo->Documento AS $dc): ?>
                            <tr>
                                <td titulo="<?= $dc->Documento->titulo ?>"><?= $dc->Documento->titulo ?></td>            
                                <td class="col-sm-1 text-center text-danger-icon"><a class="eliminar" data-iddep="<?= $modelo->id_deportista ?>" data-nomtipo="<?= $dc->Documento->url ?>" data-iddoc="<?= $dc->documento_id ?>" data-iddepdoc="<?= $dc->id ?>" href="#"><i class="fa fa-ban"></i></a></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>      
        </div>
    </div>

<?php endif; ?>
<div class="row">
    <div class="col-sm-offset-6 col-sm-3">
        <?php echo CHtml::link(CBoot::fa('undo') . ' Cancelar', ['deportista/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
    </div>
    <div class="col-sm-3">
        <?php echo CBoot::boton(CBoot::fa('save') . ' ' . ($modelo->nuevo ? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block']); ?>
    </div>
</div>

<script>
    $(function () {
        $("#btn-addAcu").click(function () {
            var m = $("#Acudientes_id_acudiente option:selected");
            var r = encontrarAcu(m.html());
            var i = m.html() !== "Seleccione un Acudiente";
            if (i && r) {
                $("#lis-acu").append("<li class='list-group-item' data='" + m.val() + "'><button onclick='eliminar(this)' type='button'><i class='text-danger fa fa-trash'></i></button> " + m.html() + "</li>");
                m.attr("disabled", "true");
                $("#form-deportistas").append("<input hidden='' name='Acudientes[]' id='" + m.val() + "' value='" + m.val() + "'>");
            } else if (i) {
                alert("El deportista actualmente tiene asociado este acudiente");
            }
            $("#Acudientes_id_acudiente").val('').attr("selected", "selected");
        });
        $("#btn-addDoc").click(function () {
            var m = $("#TiposDocumento_id_tipo option:selected");
            var i = m.html() !== "Seleccione un Tipo Documento";
            var r = encontrarDoc(m.html());
            if (i && r) {
                $("#lis-doc").append("<li class='list-group-item' d='" + m.val() + "'><button onclick='borrar(this)' type='button'><i class='text-danger fa fa-trash'></i></button> " + m.html() + "<input type='file' name='Documentos[]'></li>");
                m.attr("disabled", "true");
                $("#form-deportistas").append("<input hidden='' name='TiposDocumentos[]' id='td" + m.val() + "' value='" + m.val() + "'>");
            } else if (i) {
                alert("El deportista actualmente tiene asociado este documento");
            }
            $("#TiposDocumento_id_tipo").val('').attr("selected", "selected");
        });
        $("#birthday").datepicker({
            dateFormat: 'yy-mm-dd'
        });
        $("#form-deportistas").attr('enctype', 'multipart/form-data');
        $("a.eliminar").click(function () {
            if (confirm('¿Está seguro de eliminar este documento?')) {
                var a = $(this);
                var iddepdoc = a.attr("data-iddepdoc");
                var iddoc = a.attr("data-iddoc");
                var iddep = a.attr("data-iddep");
                var nomtipo = a.attr("data-nomtipo");
                $.ajax({
                    type: 'post',
                    url: "<?php echo Sis::crearUrl(['Deportista/EliminarDeportistaDocumento']) ?>",
                    data: {
                        iddepdoc: iddepdoc,
                        iddoc: iddoc,
                        iddep: iddep,
                        nomtipo: nomtipo
                    }
                }).done(function () {
                    $(a).closest("tr").remove();
                }).fail(function () {});
            }
            return false;
        });
        $("a.delete").click(function () {
            if (confirm('¿Está seguro de eliminar este acudiente?')) {
                var a = $(this);
                var iddepacu = a.attr("data-iddepacu");
                $.ajax({
                    type: 'post',
                    url: "<?php echo Sis::crearUrl(['Deportista/EliminarAcudiente']) ?>",
                    data: {
                        iddepacu: iddepacu
                    }
                }).done(function () {
                    $(a).closest("tr").remove();
                }).fail(function () {});
            }
            return false;
        });
    });
    function eliminar(e) {
        var d = $(e).closest('li').attr('data');
        $("#Acudientes_id_acudiente option:disabled").each(function (index) {
            if ($(this).val() === d) {
                $(this).removeAttr("disabled");
            }
        });
        $(e).closest('li').remove();
        $("#" + d).remove();
    }
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
    function encontrarDoc(tit) {
        var h = "", r = true;
        $("#tabla-documentos td[titulo]").each(function (v, e) {
            h = e.getAttribute("titulo");
            if (h === tit) {
                r = false;
            }
        });
        return r;
    }
    function encontrarAcu(tit) {
        var h = "", r = true;
        $("#tabla-acudientes td[titulo]").each(function (v, e) {
            h = e.getAttribute("titulo");
            if (h === tit) {
                r = false;
            }
        });
        return r;
    }
</script>

<?php $formulario->cerrar(); ?>