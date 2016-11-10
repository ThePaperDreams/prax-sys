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
                <?php echo $formulario->lista($modelo, 'tipo_doc_id', $tiposIdentificaciones, ['label' => true, 'group' => true, 'defecto' => 'Tipo de documento', 'data-s2' => true]) ?>
            </div>
            <div class="col-sm-6">
                <?php echo $formulario->campoNumber($modelo, 'identificacion', ['label' => true, 'group' => true, 'autofocus' => true, 'min' => '0', 'maxlength' => '15']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <?php echo $formulario->campoTexto($modelo, 'nombre1', ['label' => true, 'group' => true, 'maxlength' => '20']) ?>
            </div>
            <div class="col-sm-6">
                <?php echo $formulario->campoTexto($modelo, 'nombre2', ['label' => true, 'group' => true, 'maxlength' => '20']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <?php echo $formulario->campoTexto($modelo, 'apellido1', ['label' => true, 'group' => true, 'maxlength' => '20']) ?>
            </div>
            <div class="col-sm-6">
                <?php echo $formulario->campoTexto($modelo, 'apellido2', ['label' => true, 'group' => true, 'maxlength' => '20']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <?php echo $formulario->campoNumber($modelo, 'telefono1', ['label' => true, 'group' => true, 'min' => '0', 'maxlength' => '15']) ?>
            </div>
            <div class="col-sm-6">
                <?php echo $formulario->campoNumber($modelo, 'telefono2', ['label' => true, 'group' => true, 'min' => '0', 'maxlength' => '15']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <?php echo $formulario->campoTexto($modelo, 'direccion', ['label' => true, 'group' => true, 'maxlength' => '80']) ?>
            </div>
            <div class="col-sm-6">
                <?php echo $formulario->campoTexto($modelo, 'email', ['label' => true, 'group' => true, 'maxlength' => '60']) ?>
            </div>
        </div>                    
    </div>
        
    <div role="tabpanel" class="tab-pane" id="documentos">
        <div class="row">
            <div class="col-sm-6">
                <?php echo $formulario->lista($modelo2, 'id_tipo', $tiposDocumentos, ['label' => true, 'group' => true, 'defecto' => 'Seleccione un Tipo de documento']) ?>
            </div>
            <div class="col-sm-2">
                <?php echo CBoot::boton(CBoot::fa('plus') . ' Agregar', 'default', ['label' => true, 'group' => true, 'type' => 'button', 'class' => 'abajo', 'id' => 'btn-addDoc']) ?>
            </div>
            <?php if(count($modelo->Detalles)): ?>                   
            <div class="col-sm-4">
                <?php echo CBoot::boton(CBoot::fa('file-text-o') . ' Ver documentos asociados', 'default', ['label' => true, 'group' => true, 'type' => 'button', 'class' => 'abajo', 'data-toggle' => 'modal', 'data-target' => '#myModal', 'id' => 'btn-acudocs']) ?>
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
                                    <?php foreach ($modelo->Detalles AS $d): ?>
                                        <tr>
                                            <td><?php echo $d->Documento->getDocumento($d->Documento->url); ?>
                                            <td class="col-sm-1 text-center text-danger-icon">
                                                <a href="#" class="eliminar" data-idacudoc="<?php echo $d->id; ?>"><i class="fa fa-ban"></i></a>
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
            <?php echo CHtml::link(CBoot::fa('undo') . ' Cancelar', ['acudiente/inicio'], [ 'class' => 'btn btn-primary btn-block']); ?>
        </div>
        <div class="col-sm-3">
            <?php echo CBoot::boton(CBoot::fa('save') . ' ' . ($modelo->nuevo ? 'Guardar' : 'Actualizar'), 'success', ['id' => 'save-btn', 'class' => 'btn-block']); ?>
        </div>
    </div>
</div>
<?php $formulario->cerrar(); ?>
<script>
    $(function(){  
        var cd = 0; // Contador de documentos para los id de los input hidden        
        $("#btn-addDoc").click(function(){            
            var choice_tipo_doc = $("#TiposDocumento_id_tipo option:selected");
            if (choice_tipo_doc.val() !== "") {
                cd++;
                var nuevo = "<?php echo ($modelo->nuevo) ? 'valnombredoc': 'vnombredoc'; ?>";
                //console.log(nuevo);
                var input_text = "<input placeholder='Nombre del documento' onchange='"+nuevo+"(this)' class='form-control nomdoc' type='text' name='NombresDocumentos[]'>";
                var input_file = "<input type='file' name='Documentos[]'>";
                var button_delete = "<button numdoc='"+cd+"' type='button' onclick='eliminarDocumentoLi(this)' class='btn btn-primary'><i class='fa fa-trash'></i></button>";
                var input_hidden = "<input type='text' id='"+cd+"' hidden='' value='"+choice_tipo_doc.val()+"' name='TiposDocumentos[]'>";
                var union_elementos = "<li class='list-group-item borde-fondo'><div class='row'><div class='col-xs-12 col-sm-9 col-lg-9'>"+input_text+"</div>"+
                        "<div class='col-xs-12 col-sm-3 col-lg-3'>"+choice_tipo_doc.html()+"</div>" + 
                        "<div class='col-xs-12 col-sm-9 col-lg-9'>"+input_file+ "</div><div class='col-xs-12 col-sm-3 col-lg-3'>"+button_delete+"</div></div></li>";
                $("#list-docs").after(union_elementos);
                $("#form-acudientes").append(input_hidden);
                bonitoInputFile();    
            }
        });  
        $("a.eliminar").click(function(){
            if (confirm('¿Está seguro de eliminar este Documento?')) {
                var that_a = $(this);
                var idacudoc = that_a.attr("data-idacudoc");
                $.ajax({
                    method: "POST",
                    url: "<?php echo Sis::crearUrl(['Acudiente/EliminarAcudienteDocumento']); ?>",
                    data: {idacudoc: idacudoc}
                }).done(function(resp){
                    if (resp["tipo"] === "success") {                        
                        that_a.closest("tr").remove();
                    }
                    lobiAlert(resp.tipo, resp.msj);
                });    
            }
            return false;
        });
        $("#form-acudientes").submit(function () {
            if (validarDocumentos() && validarEmail()) {
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
                    lobiAlert("error", "Ya existe un Acudiente con esta Identificación");
                } else {
                    document.getElementById("form-acudientes").submit();
                }
            }
        });
    }
    
    function validarEmail(){
        var emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
        var email = $("#Acudientes_email").val();
        //console.log(email, emailRegex);
        if (emailRegex.test(email) || email === "") {
            return true;
        } else {
            lobiAlert('error','Ingresa un email valido');
            return false;
        }
    }
    
    function vnombredoc(e){ // Validar nombre del documento en actualizar
        if($(e).val() !== ""){
            var resp = validarNombreDocumento($.trim($(e).val().toLowerCase()));   
            //console.log(resp);
            if (resp > 1) {
                lobiAlert('error', 'Ya tienes un documento con ese nombre');
                $('#save-btn').attr("disabled", "disabled");                    
                $(e).focus();
            //} else if (resp === 0){
            } else {
                validarNombreDoc($(e).val(), e);                
            } /*else {
                //lobiAlert('success', 'Nombre valido');
                $('#save-btn').removeAttr("disabled");
            }   */          
        }
    }
    
    function validarNombreDoc(nombre, e) { // validar que el nombre del documento es unique
        $.ajax({
            type: 'POST',
            url: '<?php echo $url2 ?>',
            data: {
                validarNombreDoc: true,
                nombre: $.trim(nombre)
            },
            success: function (respuesta) {
                if (respuesta.error === true) {
                    lobiAlert('error', 'El Acudiente ya tiene un documento con ese nombre');
                    $('#save-btn').attr("disabled", "disabled");                    
                    $(e).focus();
                } else {
                    //lobiAlert('success', 'Nombre valido');
                    $('#save-btn').removeAttr("disabled");
                }
            }
        });
    }
    
    function valnombredoc(e){
        //console.log($(".form-control.nomdoc").length);
        if($(e).val() !== ""){
            //console.log($.trim($(e).val().toLowerCase()));
            var resp = validarNombreDocumento($.trim($(e).val().toLowerCase()));                
            if (resp > 1) {
                lobiAlert('error', 'Ya tienes un documento con ese nombre');
                $('#save-btn').attr("disabled", "disabled");                    
                $(e).focus();
            } else {
                //lobiAlert('success', 'Nombre valido');
                $('#save-btn').removeAttr("disabled");
            }            
        }
    }
    
    function validarNombreDocumento(nombre){ // validar nombre documento en registro
        var resp = 0; // debe coincidir al menos una vez (input que desencadena todo)
        $(".form-control.nomdoc").each(function(){
            if ($.trim($(this).val().toLowerCase()) === nombre) {
                //console.log($(this).val());
                resp++;
            } 
        });
        return resp;
    }    
    
    function validarDocumentos(){
        var resp = true;
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
    
    function eliminarDocumentoLi(e){
        $("#"+$(e).attr("numdoc")).remove(); // eliminar input hidden
        $(e).closest("li").remove(); // eliminar li       
    }
    
    function bonitoInputFile(){
        $("input[type=file]").fileinput({
            showPreview: false,
            showRemove: false,
            showUpload: false,
            browseLabel: "Seleccionar archivo",
            maxFileSize: 5000
        });    
    }
</script>
