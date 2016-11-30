<?php

Sis::Recursos()->recursoCss(['url' => Sis::urlRecursos() . 'librerias/boot-file-input/css/fileinput.min.css']);
Sis::Recursos()->recursoJs(['url' => Sis::urlRecursos() . 'librerias/boot-file-input/js/fileinput.min.js']);
Sis::Recursos()->recursoJs(['url' => Sis::urlRecursos() . 'librerias/boot-file-input/js/fileinput_locale_es.js']);

$formulario = new CBForm(['id' => 'form-acudientes', 'opcionesHtml' => ['enctype' => 'multipart/form-data']]);
$formulario->abrir();
?>

<div class="tile p-15">
<p>Los campos con <span class="text-danger">*</span>  son requeridos</p>
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#formulario" aria-controls="formulario" role="tab" >Acudiente</a></li>
    <li role="presentation"><a href="#documentos" aria-controls="documentos" role="tab" >Documentos</a></li>
</ul>

<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="formulario">
        
        <input type="hidden" name="Acudientes[usuario_id]" value="" id="usuario_id">

        <div class="row">
            <div class="col-sm-6">
                <?php echo $formulario->lista($modelo, 'tipo_doc_id', $tiposIdentificaciones, ['label' => true, 'group' => true, 'defecto' => 'Tipo de documento', 'data-s2' => true]) ?>
            </div>
            <div class="col-sm-6">
                <?php echo $formulario->campoNumber($modelo, 'identificacion', ['label' => true, 'class' => 'campo-doc r-trim-zero solo-numeros', 'group' => true, 'autofocus' => true, 'min' => '0', 'maxlength' => '15']) ?>
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
                <?php echo $formulario->campoTexto($modelo, 'telefono1', ['label' => true, 'group' => true, 'min' => '0', 'maxlength' => '15']) ?>
            </div>
            <div class="col-sm-6">
                <?php echo $formulario->campoTexto($modelo, 'telefono2', ['label' => true, 'group' => true, 'min' => '0', 'maxlength' => '15']) ?>
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
        <hr>
        <div class="row">
            <div class="col-sm-12 text-right">
                <a href="#" class="btn btn-primary tab-next" id="next-docs" data-target="#documentos">Siguiente</a>
            </div>
        </div>       
    </div>
        
    <div role="tabpanel" class="tab-pane" id="documentos">

        <div class="col-sm-6">
            <div class="page-header">
                <h4>Agregar documentos a deportista</h4>
            </div>
            <button class="btn btn-primary btn-block" id="btn-agregar-doc">
                Agregar <i class="fa fa-plus-circle"></i>
            </button>

            <table class="table table-bordered" id="documentos-cargados">
                <thead>
                    <tr>
                        <th colspan="2" class="text-center">Nuevos documentos</th>
                    </tr>
                    <tr>
                        <th>Nombre</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
        <?php if ($modelo->Detalles): ?>
            
        <div class="col-sm-6">
            <div class="page-header">
                <h4>Documentos agregados</h4>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Documento</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($modelo->Detalles as $detalle): ?>                    
                    <tr id="row-doc-<?= $detalle->id ?>" >
                        <td>
                            <a class="document-preview" href="<?= Sis::UrlBase() . '/publico/documentos/' . $detalle->Documento->url ?>" target="_blank" >
                                <?= $detalle->Documento->titulo  ?>
                            </a>
                        </td>
                        <td class="text-center">
                            <button data-id="<?= $detalle->id ?>" class="btn btn-danger remove-doc">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>

        <?php endif ?>
        
        <hr>
        <div class="row">
            <div class="col-sm-offset-4 col-sm-2">
                <a href="#" class="btn btn-default btn-block tab-next" id="next-form" data-target="#formulario" id="back-acus">Atrás</a>
            </div>
            <div class="col-sm-3">
                <?php echo CHtml::link(CBoot::fa('undo') . ' Cancelar', ['acudiente/inicio'], [ 'class' => 'btn btn-primary btn-block']); ?>
            </div>
            <div class="col-sm-3">
                <?php echo CBoot::boton(CBoot::fa('save') . ' ' . ($modelo->nuevo ? 'Guardar' : 'Actualizar'), 'success', ['id' => 'save-btn', 'class' => 'btn-block']); ?>
            </div>
        </div>  

    </div>

</div>
</div>
<?php $formulario->cerrar(); ?>
<div class="modal fade" id="modal-preview">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Previsualización</h4>
            </div>
            <div class="modal-body">
                <img src="" alt="" id="preview-img">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <a href="#" id="preview-img-download" download class="btn btn-primary">Descargar <i class="fa fa-download"></i></a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-cargar-doc">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Cargar nuevo documento
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <?php echo $formulario->lista($modelo2, 'id_tipo', $tiposDocumentos, ['label' => true, 'group' => true, 'defecto' => 'Seleccione un Tipo de documento', 'data-s2' => true]) ?>
                </div>
                <div class="form-group">
                    <label for="">Nombre del documento</label>
                    <?= CBoot::text('', ['id' => 'nombre-documento']) ?>
                </div>
                <div class="form-group">
                    <label for="">Seleccione un documento</label>
                    <div id="file-input-container">
                        <?= CBoot::fileInput('', ['id' => 'documento-cargar', 'name' => 'Documentos[]']) ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-remove"></i> Cerrar
                </button>
                <button class="btn btn-primary" id="btn-cargar-doc">
                    <i class="fa fa-floppy-o"></i> 
                    Guardar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        $("#Acudientes_identificacion").blur(function(){
            validarExistenciaUsuario();
        });
        $(".document-preview").click(function(){
            $("#preview-img").attr("src", $(this).attr("href"));
            $("#preview-img-download").attr("href", $(this).attr("href"));
            $("#modal-preview").modal("show");
            return false;
        });

        $("#next-docs").click(function(){
            if(!__validar_form__()){ return false; }
            if($("#Acudientes_identificacion").val().length < 10 ){
                lobiAlert("error", "La identificación debe ser de 10 dígitos o más");
                return false;
            }
            validarIdentificacion();

            var tab = $("a[href='" + $(this).attr("data-target") + "']");
            var nav = tab.closest(".nav-tabs");
            nav.find("li").removeClass("active");
            tab.parent().addClass("active");
            $(".tab-pane").removeClass("active");
            $(tab.attr("href")).addClass("active");
            return false;
        });

        $("#next-form").click(function(){
            var tab = $("a[href='" + $(this).attr("data-target") + "']");
            var nav = tab.closest(".nav-tabs");
            nav.find("li").removeClass("active");
            tab.parent().addClass("active");
            $(".tab-pane").removeClass("active");
            $(tab.attr("href")).addClass("active");
            return false;
        });
    });

    function validarExistenciaUsuario(){
        $.ajax({
            type: 'POST',
            url: '<?= Sis::crearUrl(["acudiente/ajx"]) ?>',
            data: {
                'consultar-usuario' : true,
                documento : $("#Acudientes_identificacion").val(),
                ajx:true,
            },
        }).done(function(data){
            if(data.error == false){
                if(data.existe == true){
                    Lobibox.confirm({
                        title: 'Documento ya registrado',
                        msg: 'Este documento ya está asociado a un usuario, puede indicar que este usuario también es acudiente ¿Desea continuar?',
                        buttons: {
                            yes: {class: 'btn btn-success', text: 'Si'},
                            no: {class: 'btn btn-default', text: 'No'},
                        },
                        callback: function($this, type, evt){
                            if(type == 'yes'){
                                $("#Acudientes_nombre1").val(data.primer_nombre);
                                $("#Acudientes_apellido1").val(data.primer_apellido);
                                $("#Acudientes_telefono1").val(data.telefono);
                                $("#Acudientes_email").val(data.email);
                                $("#Acudientes_nombre1").focus().select();
                                $("#usuario_id").val(data.id_usuario);
                            } else {
                                $("#Acudientes_identificacion").focus().select();
                                lobiAlert("error", "Debe ingresar un documento diferente");
                                $("#save-btn").attr("disabled", "disabled");
                                $("#usuario_id").val("");
                            }
                        }
                    });
                } else {
                    $("#save-btn").removeAttr("disabled");
                }
            } else {
                console.log("error al consultar");
            }
        });
    }

    function agregareldoc(){
        var nombre = $("#nombre-documento").val();
        var file = $("#documento-cargar");
        var tipoDoc = $("#TiposDocumento_id_tipo").val();
        if($.trim(tipoDoc) == ""){
            lobiAlert("error", "Debe seleccionar un tipo de documento");
            $("#TiposDocumento_id_tipo").select2('open');
            return false;
        }else if($.trim(nombre) == ""){
            lobiAlert("error", "Debe ingresar un nombre al archivo");
            $("#nombre-documento").focus();
            return false;
        }else if($.trim(file.val()) == ""){
            lobiAlert("error", "Debe cargar un archivo");
            file.focus();
            return false;
        } else if($("[data-doc='" + nombre + "']").length > 0){
            lobiAlert("error", "Ya existe un documento con ese nombre");
            $("#nombre-documento").focus().select();
            return false;
        }

        var newFile = file.clone();
        var tr = $("<tr/>", {'data-doc' : nombre});
        var td = $("<td/>");
        var tdOp = $("<td/>", {'class' : 'text-center col-sm-1'});
        var button = $("<button/>", {'class' : 'btn btn-danger'});
        var icon = $("<i/>", {'class' : 'fa fa-trash'});
        var hidden = $("<input/>", {type: 'hidden', name: 'NombresDocumentos[]' });
        var hiddenTD = $("<input/>", {type: 'hidden', name: 'TiposDocumentos[]' });
        hiddenTD.val(tipoDoc);
        hidden.val(nombre);

        button.append(icon);
        button.click(function(){
            var tr = $(this).closest("tr");
            tr.find("td").slideUp(function(){
                tr.remove();
            });
            return false;
        });

        tdOp.append(button);
        file.removeAttr("id");
        file.hide();
        td.html(nombre);
        td.append(file, hidden, hiddenTD);
        tr.append(td, tdOp);

        $("#file-input-container").html(newFile);
        $("#documento-cargar").fileinput({
            showPreview: false,
            showRemove: false,
            showUpload: false,
            browseLabel: "Seleccionar archivo",
            maxFileSize: 5000,
            allowedFileExtensions: ['jpg', 'gif', 'png', 'jpeg'],
            language: 'es',
        });
        $("#nombre-documento").val("");
        $("#documentos-cargados > tbody").append(tr);
        $("#modal-cargar-doc").modal("hide");
    }

    function removerDoc(id){
        $.ajax({
            'type' : 'POST',
            'url' : '<?= Sis::crearUrl(["acudiente/ajx"]); ?>',
            data: {
                id: id,
                'ajx' : true,
                'remover-doc' : true,
            }
        }).done(function(data){
            if(data.error == true){
                lobiAlert("error", "Ocurrió un error al remover el documento");
            } else if(data.error == false){
                var row = $("#row-doc-" + id);
                row.find("td").slideUp(function(){
                    row.remove();
                });
            } else {
                lobiAlert("error", "Ocurrió un error inesperado");
            }
        });
    }

    $(function(){

        $("#documento-cargar").fileinput({
            showPreview: false,
            showRemove: false,
            showUpload: false,
            browseLabel: "Seleccionar archivo",
            maxFileSize: 5000,
            allowedFileExtensions: ['jpg', 'gif', 'png', 'jpeg']
        });

        $(".remove-doc").click(function(){
            var id = $(this).attr("data-id");
            if(confirm("¿Realmente desea remover este documento?")){
                removerDoc(id);
                return false;
            }
        });

        $("#btn-agregar-doc").click(function(){
            $("#modal-cargar-doc").modal("show");
            setTimeout(function(){
                $("#TiposDocumento_id_tipo").select2('open');
            }, 500);
            return false;
        });
        $("#btn-cargar-doc").click(function(){
            agregareldoc();
            return false;
        });
    });

</script>

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
                document.getElementById("form-acudientes").submit();
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
                    setTimeout(function(){
                        var tab = $("a[href='#formulario']");
                        var nav = tab.closest(".nav-tabs");
                        nav.find("li").removeClass("active");
                        tab.parent().addClass("active");
                        $(".tab-pane").removeClass("active");
                        $(tab.attr("href")).addClass("active");
                        return false;
                    }, 100);
                } else {
                    // document.getElementById("form-acudientes").submit();
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
