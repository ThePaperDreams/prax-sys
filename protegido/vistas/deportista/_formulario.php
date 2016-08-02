<?php
Sis::Recursos()->recursoCss(['url' => Sis::urlRecursos() . 'librerias/boot-file-input/css/fileinput.min.css']);
Sis::Recursos()->recursoJs(['url' => Sis::urlRecursos() . 'librerias/boot-file-input/js/fileinput.min.js']);
$formulario = new CBForm(['id' => 'form-deportistas']);
$formulario->abrir();
?>
<div class="tile p-15">
<p>Los campos con <span class="text-danger">*</span>  son requeridos</p>

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
        <?php echo $formulario->campoTexto($modelo, 'fecha_nacimiento', ['label' => true, 'group' => true]) ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <?php echo $formulario->campoArchivo($modelo, 'foto', ['label' => true, 'group' => true]) ?>
    </div>
    <div class="col-sm-6">
        <?php echo $formulario->lista($modelo, 'estado_id', $estados, ['label' => true, 'group' => true]) ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        <?php echo $formulario->lista($modelo2, 'id_acudiente', $acudientes, ['label' => true, 'group' => true, 'defecto' => 'Acudiente']) ?>
    </div>
    <div class="col-sm-2">
        <?php echo CBoot::boton(CBoot::fa('plus') . ' Agregar', 'default', ['label' => true, 'group' => true, 'type' => 'button', 'class' => 'abajo', 'id' => 'btn-addAcu']) ?>
    </div>
    <div class="col-sm-4">
        <?php echo $formulario->lista($modelo3, 'id_tipo', $tiposDocumentos, ['label' => true, 'group' => true, 'defecto' => 'Tipo de Documento']) ?>
    </div>
    <div class="col-sm-2">
        <?php echo CBoot::boton(CBoot::fa('plus') . ' Agregar', 'default', ['label' => true, 'group' => true, 'type' => 'button', 'class' => 'abajo', 'id' => 'btn-addDoc']) ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div id="lst-acu" class="panel-default">
            <div class="panel-heading">Acudientes</div>
            <ul id="lis-acu" class="list-group">
            </ul>
        </div>
    </div>
    <div class="col-sm-6">
        <div id="lst-doc" class="panel-default">
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
                    Acudientes asociados actualmente
                </div>            
                <table class="table table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th>Acudiente</th>
                            <th>Eliminar</th>
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
                    Documentos asociados actualmente
                </div>            
                <table class="table table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th>Documento</th>
                            <th>Eliminar</th>
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
        <?php echo CBoot::boton(CBoot::fa('save') . ' ' . ($modelo->nuevo ? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block', 'id' => 'btn-send']); ?>
    </div>
</div>
    </div>
<?php $formulario->cerrar(); ?>
<script>
    $(function () {
        files();
        $("#btn-addAcu").click(function () {
            var m = $("#Acudientes_id_acudiente option:selected");
            var r = encontrarAcu(m.html());
            var i = m.html() !== "Acudiente";
            if (i && r) {
                $("#lis-acu").append("<li class='list-group-item' data='" + m.val() + "'><button class='btn btn-primary' onclick='eliminar(this)' type='button'><i class='fa fa-trash'></i> " + m.html() + "</button></li>");
                m.attr("disabled", "true");
                $("#form-deportistas").append("<input hidden='' name='Acudientes[]' id='" + m.val() + "' value='" + m.val() + "'>");
            } else if (i) {
                alert("El deportista actualmente tiene asociado este acudiente");
            }
            $("#Acudientes_id_acudiente").val('').attr("selected", "selected");
        });
        $("#btn-addDoc").click(function () {
            var m = $("#TiposDocumento_id_tipo option:selected");
            var i = m.html() !== "Tipo de Documento";
            var r = encontrarDoc(m.html());
            if (i && r) {
                $("#lis-doc").append("<li class='list-group-item' d='" + m.val() + "'><button class='btn btn-primary' onclick='borrar(this)' type='button'><i class='fa fa-trash'></i> " + m.html() + "</button><input type='file' name='Documentos[]'></li>");
                files();
                m.attr("disabled", "true");
                $("#form-deportistas").append("<input hidden='' name='TiposDocumentos[]' id='td" + m.val() + "' value='" + m.val() + "'>");
            } else if (i) {
                alert("El deportista actualmente tiene asociado este documento");
            }
            $("#TiposDocumento_id_tipo").val('').attr("selected", "selected");
        });
        $("#Deportistas_fecha_nacimiento").datepicker({
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
        $("#form-deportistas").submit(function () {
            validarIdentificacion();
            return false;
        });
        $("#Deportistas_fecha_nacimiento").change(function(){
            validarFecha($(this));
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
    function files(){
        $("input[type=file]").fileinput({
                    showPreview: false,
                    showRemove: false,
                    showUpload: false,
                    browseLabel: "Seleccionar archivo",
                });
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
    
    function validarIdentificacion() {
            var identificacion = $("#Deportistas_identificacion");
            if (identificacion === "") {
                return;
            }

            $.ajax({
                type: 'POST',
                url: '<?php echo $url ?>',
                data: {
                    validarIdentificacion: true,
                    identificacion: identificacion.val(),
                },
                success: function (respuesta) {
                    if (respuesta.error == true) {
                        mostrarAlert("error", "Ya existe esa Identificación");
                    } else {
                        document.getElementById("form-deportistas").submit();
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

    function parseDate(input) {
        var parts = input.split('-');
        // new Date(year, month [, day [, hours[, minutes[, seconds[, ms]]]]])
        return new Date(parts[0], parts[1]-1, parts[2]); // Note: months are 0-based
    }
        
    function validarFecha(fecha) {
        var currDate = new Date();
        var date = parseDate(fecha.val());
        var tot = currDate.getFullYear() - date.getFullYear();
        //console.log(tot);
        if (tot <= 5 || tot > 17) {
            mostrarAlert('error', 'Seleccione una fecha valida');
            $('#btn-send').attr("disabled", "disabled");
        } else {
            mostrarAlert('success', 'Fecha valida');
            $('#btn-send').removeAttr("disabled");
        }
    }
</script>