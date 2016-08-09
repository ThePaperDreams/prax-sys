<?php
Sis::Recursos()->recursoCss(['url' => Sis::urlRecursos() . 'librerias/boot-file-input/css/fileinput.min.css']);
Sis::Recursos()->recursoJs(['url' => Sis::urlRecursos() . 'librerias/boot-file-input/js/fileinput.min.js']);
$formulario = new CBForm(['id' => 'form-acudientes', 'opcionesHtml' => ['enctype' => 'multipart/form-data']]);
$formulario->abrir();
?>

<div class="tile p-15">
<p>Los campos con <span class="text-danger">*</span>  son requeridos</p>
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#formulario" aria-controls="formulario" role="tab" data-toggle="tab">Acudiente</a></li>
    <li role="presentation"><a href="#documentos" aria-controls="documentos" role="tab" data-toggle="tab">Documentos</a></li>
</ul>
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="formulario">
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
            <div class="col-sm-offset-6 col-sm-3">
                <?php echo CHtml::link(CBoot::fa('undo') . ' Cancelar', ['acudiente/inicio'], [ 'class' => 'btn btn-primary btn-block']); ?>
            </div>
            <div class="col-sm-3">
                <?php echo CBoot::boton(CBoot::fa('save') . ' ' . ($modelo->nuevo ? 'Guardar' : 'Actualizar'), 'success', ['id' => 'save-btn', 'class' => 'btn-block']); ?>
            </div>
        </div>            
    </div>
        
    <div role="tabpanel" class="tab-pane" id="documentos">
        <div class="row">
            <div class="col-sm-4">
                <?php echo $formulario->lista($modelo2, 'id_tipo', $tiposDocumentos, ['label' => true, 'group' => true, 'defecto' => 'Seleccione Tipo Documento']) ?>
            </div>
            <div class="col-sm-2">
                <?php echo CBoot::boton(CBoot::fa('plus-circle') . ' Agregar', 'default', ['label' => true, 'group' => true, 'type' => 'button', 'class' => 'abajo', 'id' => 'btn-addDoc']) ?>
            </div>
        </div>
        <?php if ($modelo->nuevo): ?>
            <div class="row">
                <div class="col-sm-12">
        <?php else: ?>
            <div class="row">
                <div class="col-sm-6">
        <?php endif; ?>
                    <div id="lst-doc" class="panel-default">
                        <div class="panel-heading">Documentos</div>
                            <ul id="lis-doc" class="list-group"></ul>
                        </div>
                    </div>
        <?php if (!$modelo->nuevo): ?>
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">Documentos asociados Actualmente</div>            
                            <table class="table table-bordered table-condensed">
                                <thead>
                                    <tr>
                                        <th>Documento</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody id="tabla-documentos">
                                    <?php foreach ($modelo->Detalles AS $dc): ?>
                                        <tr>
                                            <td titulo="<?= $dc->Documento->titulo ?>"><?= $dc->Documento->titulo ?></td>            
                                            <td class="col-sm-1 text-center text-danger-icon"><a class="eliminar" data-idacu="<?= $modelo->id_acudiente ?>" data-nomtipo="<?= $dc->Documento->url ?>" data-iddoc="<?= $dc->documento_id ?>" data-idacudoc="<?= $dc->id ?>" href="#"><i class="fa fa-ban"></i></a></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>    
        <?php endif ?>
                </div>
            </div>
    </div>
</div>
<?php $formulario->cerrar(); ?>
<script>
    $(function () {
        $("#btn-addDoc").click(function () {
            var m = $("#TiposDocumento_id_tipo option:selected");
            var r = encontrar(m.html());
            var i = m.html() !== "Seleccione Tipo Documento";
            if (i && r) {
                $("#lis-doc").append("<li class='list-group-item' d='" + m.val() + "'><button class='btn btn-primary' onclick='borrar(this)' type='button'><i class='fa fa-trash'> </i> " + m.html() + "</button><input type='file' name='Documentos[]'></li>");
                $("input[type=file]").fileinput({
                    showPreview: false,
                    showRemove: false,
                    showUpload: false,
                    browseLabel: "Seleccionar archivo",
                });
                m.attr("disabled", "true");
                $("#form-acudientes").append("<input hidden='' name='TiposDocumentos[]' id='td" + m.val() + "' value='" + m.val() + "'>");
            } else if (i) {
                alert("El acudiente actualmente tiene este documento");
            }
            $("#TiposDocumento_id_tipo").val('').attr("selected", "selected");
        });
        $(".eliminar").click(function () {
            if (confirm('¿Está seguro de eliminar este documento?')) {
                var a = $(this);
                var idacudoc = a.attr("data-idacudoc");
                var iddoc = a.attr("data-iddoc");
                var idacu = a.attr("data-idacu");
                var nomtipo = a.attr("data-nomtipo");
                $.ajax({
                    type: 'post',
                    url: "<?php echo Sis::crearUrl(['Acudiente/EliminarAcudienteDocumento']) ?>",
                    data: {
                        idacudoc: idacudoc,
                        iddoc: iddoc,
                        idacu: idacu,
                        nomtipo: nomtipo
                    }
                }).done(function () {
                    $(a).closest("tr").remove();
                }).fail(function () {});
            }
            return false;
        });
        $("#form-acudientes").submit(function () {
            if (validarDocumentos()) {
                validarIdentificacion();
            }            
            return false;
        });
    });

    function validarIdentificacion() {
        var identificacion = $("#Acudientes_identificacion").val();
        if (identificacion === "") {
            return;
        }
        $.ajax({
            type: 'POST',
            url: '<?php echo $url ?>',
            data: {
                validarIdentificacion: true,
                identificacion: $.trim(identificacion),
            },
            success: function (respuesta) {
                if (respuesta.error === true) {
                    mostrarAlert("error", "Ya existe esa Identificación");
                } else {
                    document.getElementById("form-acudientes").submit();
                }
            }
        });
    }
    
    function validarDocumentos(){
        var resp = true;
        $("#lis-doc li input").each(function(){  
            if ($(this).val() === "") {
                resp = false;
            }
        });
        if (!resp) {
            lobiAlert('error', 'Debes subir los documentos');
        }
        return resp;
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
    function encontrar(tit) {
        var h = "", r = true;
        $("#tabla-documentos td[titulo]").each(function (v, e) {
            h = e.getAttribute("titulo");
            if (h === tit) {
                r = false;
            }
        });
        return r;
    }
</script>