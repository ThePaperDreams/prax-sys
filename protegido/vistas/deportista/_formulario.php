<?php
Sis::Recursos()->recursoCss(['url' => Sis::urlRecursos() . 'librerias/boot-file-input/css/fileinput.min.css']);
Sis::Recursos()->recursoJs(['url' => Sis::urlRecursos() . 'librerias/boot-file-input/js/fileinput.min.js']);
$formulario = new CBForm(['id' => 'form-deportistas', 'opcionesHtml' => ['enctype' => 'multipart/form-data']]);
$formulario->abrir();
?>
<div class="tile p-15">
<p>Los campos con <span class="text-danger">*</span>  son requeridos</p>
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#formulario" aria-controls="formulario" role="tab" data-toggle="tab">Deportista</a></li>
    <li role="presentation"><a href="#acus" aria-controls="acus" role="tab" data-toggle="tab">Acudientes</a></li>
    <li role="presentation"><a href="#documentos" aria-controls="documentos" role="tab" data-toggle="tab">Documentos</a></li>
</ul>
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="formulario">
        <div class="row">    
            <div class="col-sm-6">
                <?php echo $formulario->lista($modelo, 'tipo_documento_id', $tiposIdentificaciones, ['label' => true, 'group' => true, 'defecto' => 'Seleccione un Tipo de documento']) ?>
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
                <?php echo $formulario->campoTexto($modelo, 'fecha_nacimiento', ['label' => true, 'group' => true, 'class' => 'campo-fecha']) ?>
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
    </div>
    
    <div role="tabpanel" class="tab-pane" id="acus">
        <div class="row">
            <div class="col-sm-6">
                <?php echo $formulario->lista($modelo2, 'id_acudiente', $acudientes, ['label' => true, 'group' => true, 'defecto' => 'Seleccione un Acudiente']) ?>
            </div>
            <div class="col-sm-2">
                <?php echo CBoot::boton(CBoot::fa('plus') . ' Agregar', 'default', ['label' => true, 'group' => true, 'type' => 'button', 'class' => 'abajo', 'id' => 'btn-addAcu']) ?>
            </div>
            <?php if(!$modelo->nuevo): ?>                   
            <div class="col-sm-4">
                <?php echo CBoot::boton(CBoot::fa('file-text-o') . ' Ver acudientes asociados', 'default', ['label' => true, 'group' => true, 'type' => 'button', 'class' => 'abajo', 'data-toggle' => 'modal', 'data-target' => '#myModal1']) ?>
            </div>
            <div class="modal fade cortina" id="myModal1" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="p-modal-content">
                        <div class="p-modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Acudientes </h4>
                        </div>
                        <div class="p-modal-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Acudiente</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody id="tabla-acudientes">
                                    <?php foreach ($modelo->Acudiente AS $dc): ?>
                                        <tr>
                                            <td val="<?= $dc->Acudiente->id_acudiente ?>"><?= $dc->Acudiente->getAcudiente($dc->Acudiente->id_acudiente, $dc->Acudiente->datos); ?></td>            
                                            <td class="col-sm-1 text-center text-danger-icon"><a class="delete" data-iddepacu="<?= $dc->id ?>" href="#"><i class="fa fa-ban"></i></a></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="p-modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        
        <div class="row">
            <div class="col-sm-12">
                <div id="lst-acu" class="panel-default">
                    <div class="panel-heading">Acudientes</div>
                        <ul id="lis-acu" class="list-group"></ul>
                </div>
            </div>        
        </div>
    </div>
        
    <div role="tabpanel" class="tab-pane" id="documentos">
        <div class="row">
            <div class="col-sm-6">
                <?php echo $formulario->lista($modelo3, 'id_tipo', $tiposDocumentos, ['label' => true, 'group' => true, 'defecto' => 'Seleccione un Tipo de documento']) ?>
            </div>
            <div class="col-sm-2">
                <?php echo CBoot::boton(CBoot::fa('plus') . ' Agregar', 'default', ['label' => true, 'group' => true, 'type' => 'button', 'class' => 'abajo', 'id' => 'btn-addDoc']) ?>
            </div>
            <?php if(count($modelo->Documento)): ?>                   
            <div class="col-sm-4">
                <?php echo CBoot::boton(CBoot::fa('file-text-o') . ' Ver documentos asociados', 'default', ['label' => true, 'group' => true, 'type' => 'button', 'class' => 'abajo', 'data-toggle' => 'modal', 'data-target' => '#myModal']) ?>
            </div>
            <div class="modal fade cortina" id="myModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="p-modal-content">
                        <div class="p-modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Documentos </h4>
                        </div>
                        <div class="p-modal-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Documento</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($modelo->Documento AS $d): ?>
                                        <tr>
                                            <td><?php echo $d->Documento->getDocumento($d->Documento->url); ?>
                                            <td class="col-sm-1 text-center text-danger-icon">
                                                <a href="#" class="eliminar" data-iddepdoc="<?php echo $d->id; ?>"><i class="fa fa-ban"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="p-modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-sm-12">        
                <div id="lst-doc" class="panel-default">
                    <div class="panel-heading">Documentos</div>
                    <ul id="list-docs" class="list-group"></ul>
                </div>
            </div>
        </div>
    </div>
</div>                
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
    $(function(){  
        var cd = 0; // Contador de documentos para los id de los input hidden
        bonitoInputFile(); // Para embellecer el file input de la foto
        $("#btn-addDoc").click(function(){ // agregar documentos nuevos       
            var choice_tipo_doc = $("#TiposDocumento_id_tipo option:selected");
            if (choice_tipo_doc.val() !== "") {
                cd++;
                var input_text = "<input placeholder='Nombre del documento' class='form-control' type='text' name='NombresDocumentos[]'>";
                var input_file = "<input type='file' name='Documentos[]'>";
                var button_delete = "<button numdoc='"+cd+"' type='button' onclick='eliminarDocumentoLi(this)' class='btn btn-primary'><i class='fa fa-trash'></i></button>";
                var input_hidden = "<input type='text' id='"+cd+"' hidden='' value='"+choice_tipo_doc.val()+"' name='TiposDocumentos[]'>";
                var union_elementos = "<li class='list-group-item borde-fondo'><div class='row'><div class='col-xs-12 col-sm-9 col-lg-9'>"+input_text+"</div>"+
                        "<div class='col-xs-12 col-sm-3 col-lg-3'>"+choice_tipo_doc.html()+"</div>" + 
                        "<div class='col-xs-12 col-sm-9 col-lg-9'>"+input_file+ "</div><div class='col-xs-12 col-sm-3 col-lg-3'>"+button_delete+"</div></div></li>";
                $("#list-docs").after(union_elementos);
                $("#form-deportistas").append(input_hidden);
                bonitoInputFile();    
            }
        }); 
        $("#btn-addAcu").click(function () { // agregar acudientes nuevos
            var e = $("#Acudientes_id_acudiente option:selected");
            var acu_existe = encontrarAcu(e.val());
            var acu_valido = e.val() !== "";
            if (acu_valido && acu_existe) {
                $("#lis-acu").append("<li class='list-group-item' data='" + e.val() + "'><button class='btn btn-block btn-primary' onclick='eliminar(this)' type='button'><i class='fa fa-trash'></i> " + e.html() + "</button></li>");
                $("#form-deportistas").append("<input hidden='' name='Acudient[]' id='a" + e.val() + "' value='" + e.val() + "'>");
            } else if (acu_valido) {
                lobiAlert("error","El Deportista ya tiene asociado este Acudiente");
            }            
        });
        $("a.delete").click(function () { // eliminar acudiente ya asociado al deportista
            if (confirm('¿Está seguro de eliminar este Acudiente?')) {
                var a = $(this);
                var iddepacu = a.attr("data-iddepacu");
                $.ajax({
                    type: 'post',
                    url: "<?php echo Sis::crearUrl(['Deportista/EliminarAcudiente']) ?>",
                    data: {iddepacu: iddepacu}
                }).done(function (resp) {
                    if (resp["tipo"] === "success") {
                        $(a).closest("tr").remove();    
                    }
                    lobiAlert(resp.tipo, resp.msj);
                });
            }
            return false;
        });
        $("a.eliminar").click(function(){ // eliminar documento ya asociado al deportista
            if (confirm('¿Está seguro de eliminar este Documento?')) {
                var that_a = $(this);
                var iddepdoc = that_a.attr("data-iddepdoc");
                $.ajax({
                    method: "POST",
                    url: "<?php echo Sis::crearUrl(['Deportista/EliminarDeportistaDocumento']); ?>",
                    data: {iddepdoc: iddepdoc}
                }).done(function(resp){
                    if (resp["tipo"] === "success") {                        
                        that_a.closest("tr").remove();
                    }
                    lobiAlert(resp.tipo, resp.msj);
                });    
            }
            return false;
        });
        $("#form-deportistas").submit(function () {
            if (validarAcudiente()) {
                if (validarDocumentos()) {
                    validarIdentificacion();                    
                }
            }
            return false;
        });
        $("#Deportistas_fecha_nacimiento").change(function(){
            validarFecha($(this));
        });
    });
    
    function validarIdentificacion() { // validar que la identificacion es unique
        var identificacion = $("#Deportistas_identificacion").val();
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
                    lobiAlert("error", "Ya existe un Deportista con esta Identificación");
                } else {
                    document.getElementById("form-deportistas").submit();
                }
            }
        });
    }
    
    function validarDocumentos(){ // Validar que se ingrese el nombre y se suba algun archivo a los
        var resp = true;            // file input documentos
        $("#lst-doc li input").each(function(){  
            if ($(this).val() === "") {
                resp = false;
            }
        });
        if (!resp) {
            lobiAlert('error', 'Te falta subir un documento o incluir su nombre');
        }
        return resp;
    }
    
    function eliminarDocumentoLi(e){ // eliminar el documento (aun no asociado al deportista) de la lista
        $("#"+$(e).attr("numdoc")).remove(); // eliminar input hidden
        $(e).closest("li").remove(); // eliminar li       
    }
    
    function bonitoInputFile(){ // embellecer el file input
        $("input[type=file]").fileinput({
            showPreview: false,
            showRemove: false,
            showUpload: false,
            browseLabel: "Seleccionar archivo"
        });    
    }
    
    function encontrarAcu(val) { // ¿El Deportista ya esta asociado con el acudiente?
        var current_val = "", existe = true;
        $("#tabla-acudientes td[val]").each(function (v, e) {
            current_val = e.getAttribute("val");
            if (current_val === val) {
                existe = false;
            }
        });
        $("#lis-acu li[data]").each(function (v, e) {
            current_val = e.getAttribute("data");
            if (current_val === val) {
                existe = false;
            }
        });
        return existe;
    }
    
    function eliminar(e) { // Eliminar acudiente (aun no asociado al deportista) de la lista
        var id_input_hidden = $(e).closest('li').attr('data');
        $(e).closest('li').remove();
        $("#a" + id_input_hidden).remove();
    }
    
    function validarFecha(fecha) { // Validar rango de edad del deportista
        var anios = new Date(new Date - new Date(fecha.val())).getFullYear()-1970;       
        //console.log(anios);
        if (anios < 5 || anios > 17) {
            lobiAlert('error', 'Seleccione una fecha valida');
            $('#btn-send').attr("disabled", "disabled");
        } else {
            lobiAlert('success', 'Fecha valida');
            $('#btn-send').removeAttr("disabled");
        }
    }
    
    function validarAcudiente(){ // Validar que este asociado como minimo un acudiente o
        var resp = true;           // se vaya a asociar uno (lista de acudientes nuevos) 
        var x = $('#lis-acu li').length;
        var y = $('#tabla-acudientes tr').length;
        if (x < 1 && y === 0) {
            resp = false;
            lobiAlert('error', 'El Deportista debe contar mínimo con un Acudiente');   
        }
        return resp;
    }
</script>