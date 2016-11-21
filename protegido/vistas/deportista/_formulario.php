<?php
$this->ayuda = "deportistas/crear";
$this->ayudaTitulo = "Registrar / Modificar Deportista";

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
                <?php echo $formulario->lista($modelo, 'tipo_documento_id', $tiposIdentificaciones, ['label' => true, 'group' => true, 'defecto' => 'Seleccione un Tipo de documento', 'data-s2' => true]) ?>
            </div>
            <div class="col-sm-6">
                <?php echo $formulario->campoNumber($modelo, 'identificacion', ['class' => 'campo-doc solo-numeros r-trim-zero', 'label' => true, 'group' => true, 'autofocus' => true,  'min' => '0', 'maxlength' => '45']) ?>
            </div>    
        </div>
        <div class="row">
            <div class="col-sm-6">
                <?php echo $formulario->campoTexto($modelo, 'nombre1', ['label' => true, 'group' => true, 'maxlength' => '15']) ?>
            </div>
            <div class="col-sm-6">
                <?php echo $formulario->campoTexto($modelo, 'nombre2', ['label' => true, 'group' => true, 'maxlength' => '15']) ?>
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
                <?php echo $formulario->campoTexto($modelo, 'telefono1', ['label' => true, 'group' => true, 'min' => '0', 'maxlength' => '50']) ?>
            </div>
            <div class="col-sm-6">
                <?php echo $formulario->campoTexto($modelo, 'telefono2', ['label' => true, 'group' => true, 'min' => '0', 'maxlength' => '50']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <?php echo $formulario->campoTexto($modelo, 'direccion', ['label' => true, 'group' => true, 'maxlength' => '80']) ?>
            </div>
            <div class="col-sm-6">
                <?php echo $formulario->inputAddon($modelo, 'fecha_nacimiento', 'text', ['readonly' => true, 'label' => true, 'class' => 'campo-fecha'], ['pos' => CBoot::fa('calendar', ['id' => 'display-date'])]) ?>
            </div>
        </div>
        <div class="row">  
            <input hidden="" value="0" id="change-foto" name="cambio-foto">
            <?php if (is_null($modelo->foto) !== true): ?>
                <div class="col-sm-6">
                    <?php echo CBoot::botonP('Cambiar foto', ['type' => 'button', 'label' => true, 'group' => true, 'id' => 'btn-cambiarFoto', 'onClick' => 'activarCambioFoto()', 'class' => 'btn-block abajo', 'data' => '0']) ?>
                </div>    
            <?php endif; ?>
            <div class="col-sm-6" <?php if (is_null($modelo->foto) !== true): ?>style="display:none" id="fotos"<?php endif; ?>>
                <?php echo $formulario->campoArchivo($modelo, 'foto', ['label' => true, 'group' => true]) ?>
            </div>
            <div class="col-sm-6">
                <?php echo $formulario->lista($modelo, 'estado_id', $estados, ['label' => true, 'group' => true, 'data-s2' => true]) ?>
            </div>
        </div>        
    </div>
    
    <div role="tabpanel" class="tab-pane" id="acus">
        <div class="row">
            <div class="col-sm-6">
                <?php echo $formulario->lista($modelo2, 'id_acudiente', $acudientes, ['label' => true, 'group' => true, 'defecto' => 'Seleccione un Acudiente', 'data-s2' => true]) ?>
            </div>
            <div class="col-sm-6">
                <!-- <?php echo CBoot::boton(CBoot::fa('plus') . ' Agregar', 'default', ['label' => true, 'group' => true, 'type' => 'button', 'class' => 'abajo', 'id' => 'btn-addAcu']) ?> -->
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default abajo" id="btn-addAcu"><i class="fa fa-plus"></i> Agregar</button>
                    <button type="button" class="btn btn-success abajo" id="btn-registrar-acudiente"><i class="fa fa-user-plus"></i> Registrar acudiente</button>
                </div>

            </div>

            <?php if(!$modelo->nuevo): ?>      
            <!-- 
            <div class="col-sm-4">
                <?php echo CBoot::boton(CBoot::fa('file-text-o') . ' Ver acudientes asociados', 'default', ['label' => true, 'group' => true, 'type' => 'button', 'class' => 'abajo', 'data-toggle' => 'modal', 'data-target' => '#myModal1', 'id' => 'btn-veracus']) ?>
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
             -->
            <?php endif; ?>
        </div>
        
        <div class="row">
            <div class="col-sm-12">
                <div class="panel-default">                    
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Acudiente</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody id="tab-acus">
                        <?php foreach ($modelo->Acudiente AS $dc): ?>
                            <tr>
                                <td><?= $dc->Acudiente->getAcudiente($dc->Acudiente->id_acudiente, $dc->Acudiente->datos); ?></td>            
                                <td data="<?= $dc->Acudiente->id_acudiente ?>" val="<?= $dc->Acudiente->id_acudiente ?>" class="x col-sm-1 text-center text-danger-icon"><a class="delete-person" data-iddepacu="<?= $dc->id ?>" href="#"><i class="fa fa-ban"></i></a></td>
                            </tr>
                        <?php endforeach ?>                    
                        </tbody>
                    </table>                                            
                </div>
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
        <?php if ($modelo->Documento): ?>
            
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
                <?php foreach ($modelo->Documento as $detalle): ?>                    
                    <tr id="row-doc-<?= $detalle->id ?>" >
                        <td>
                            <a href="<?= Sis::UrlBase() . '/publico/documentos/' . $detalle->Documento->url ?>" target="_blank" >
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

<div id="acudientes-eliminados">
    
</div>

<?php $formulario->cerrar(); ?>

<div class="modal fade" id="modal-cargar-doc">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Cargar nuevo documento
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <?php echo $formulario->lista($modelo3, 'id_tipo', $tiposDocumentos, ['label' => true, 'group' => true, 'defecto' => 'Seleccione un Tipo de documento', 'data-s2' => true]) ?>
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

<div class="modal fade" id="modal-acudientes">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                
            </div>
            <div class="modal-body">
                <?= $formularioAcudiente ?>
            </div>

            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-remove"></i> Cancelar
                </button>
                <button class="btn btn-primary" id="guardar-acudiente">
                    <i class="fa fa-floppy-o"></i> 
                    Guardar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        $(".delete-person").click(function(){

            var id = $(this).attr("data-iddepacu");
            var input = $("<input/>", {type: 'hidden', name: 'acudientes-borrados[]'});
            input.val(id);
            $("#acudientes-eliminados").append(input);
            var tr = $(this).closest("tr");
            tr.find("td").slideUp(function(){
                tr.remove();
            });

        });
    });
</script>

<script type="text/javascript">

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
            lobiAlert("error", "Debe ingresar un nombre al archivo");
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
            allowedFileExtensions: ['jpg', 'gif', 'png', 'jpeg']
        });
        $("#nombre-documento").val("");
        $("#documentos-cargados > tbody").append(tr);
        $("#modal-cargar-doc").modal("hide");
    }

    function removerDoc(id){
        $.ajax({
            'type' : 'POST',
            'url' : '<?= Sis::crearUrl(["deportista/ajx"]); ?>',
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

    $(function(){       

        $("#btn-registrar-acudiente").click(function(){
            $("#modal-acudientes").modal("show");
        });

        $("#guardar-acudiente").click(function(){
            guardarAcudiente();
            return false;
        });

    });   

    function guardarAcudiente(){
        var formulario = $("#form-acudientes").serializeArray();
        var campos = {};
        var requeridos = false;

        $.each(formulario, function(k,v){
            var key = v.name.replace(/Acudientes\[/g, '').replace(/\]/g, '');
            var campo = $("[name='" + v.name + "']");
            if(campo.attr("requerido") == "1" && $.trim(campo.val()) == ""){
                requeridos = true;
            }
            campos[key] = v.value;
        });

        if(requeridos){
            lobiAlert("error", "Los campos con * son requeridos");
            return false;
        }

        var limpiarCampos = function(){
            $.each(formulario, function(k,v){
                var campo = $("[name='" + v.name + "']");
                campo.val("");
            });            
        };

        var agregarOpcion = function (datos){
            var opcion = $("<option/>").val(datos.id).html(datos.nombre);
            var select = $("#Acudientes_id_acudiente");
            select.select2("destroy");
            select.append(opcion);
            select.select2({
                'width' : '100%',
            });
            select.select2("open");
        };

        console.log(campos, formulario);
        $.ajax({
            type:'POST',
            url: '<?= Sis::crearUrl(['deportista/ajax']) ?>',
            data: {
                tipo: 'guardar-acudiente',
                ajx_request: true,
                modelo: campos,
            }
        }).done(function(obj){
            if(obj.error == true){
                lobiAlert('error', obj.msg);
                $("#modal-acudientes").modal("hide");
                limpiarCampos();
            } else if(obj.error == false) {
                lobiAlert('success', obj.msg);
                $("#modal-acudientes").modal("hide");                
                agregarOpcion(obj.acudiente);
            } else {
                alert("Ocurrió un error inesperado");
                console.log(obj);
            }
        });
    } 
</script>

<script>
    $(function(){ 
        // bug que abre el modal de documentos
        $("#Deportistas_fecha_nacimiento").on('keyup keydown keypress', function(e){
            e.preventDefault();
            return false;
        });

        $("#display-date").click(function(){
            $("#Deportistas_fecha_nacimiento").focus();
        });

        var cd = 0; // Contador de documentos para los id de los input hidden
        //bonitoInputFile(); 
        $("input[type=file]").fileinput({ // Para embellecer el file input de la foto
            showPreview: false,
            showRemove: false,
            showUpload: false,
            browseLabel: "Seleccionar archivo",
            maxFileSize: 5000,
            allowedFileExtensions: ['jpg', 'gif', 'png', 'jpeg']
        });    
        $("#btn-addDoc").click(function(){ // agregar documentos nuevos       
            var choice_tipo_doc = $("#TiposDocumento_id_tipo option:selected");
            if (choice_tipo_doc.val() !== "") {
                cd++;
                var nuevo = "<?php echo ($modelo->nuevo) ? 'valnombredoc': 'vnombredoc'; ?>";
                var input_text = "<input placeholder='Nombre del documento' class='form-control nomdoc' onchange='"+nuevo+"(this)' type='text' name='NombresDocumentos[]'>";
                var input_file = "<input type='file' name='Documentos[]'>";
                var button_delete = "<button numdoc='"+cd+"' type='button' onclick='eliminarDocumentoLi(this)' class='btn btn-primary'><i class='fa fa-trash'></i></button>";
                var input_hidden = "<input type='text' id='"+cd+"' hidden='' value='"+choice_tipo_doc.val()+"' name='TiposDocumentos[]'>";
                var union_elementos = "<li class='list-group-item borde-fondo'><div class='row'><div class='col-xs-12 col-sm-9 col-lg-9'>"+input_text+"</div>"+
                        "<div class='col-xs-12 col-sm-3 col-lg-3'>"+choice_tipo_doc.html()+"</div>" + 
                        "<div class='col-xs-12 col-sm-9 col-lg-9'>"+input_file+ "</div><div class='col-xs-12 col-sm-3 col-lg-3'>"+button_delete+"</div></div></li>";
                $("#list-docs").after(union_elementos);
                $("#form-deportistas").append(input_hidden);
                bonitoInputFile();    // embellecer el file input documentos
            }
        });
        $("#btn-addAcu").click(function () { // agregar acudientes nuevos
            var e = $("#Acudientes_id_acudiente option:selected");
            var acu_existe = encontrarAcu(e.val());
            var acu_valido = e.val() !== "";
            //console.log(acu_existe);
            if (acu_valido && acu_existe === 1) {                   
                var td_info_acu = "<td><a target='_blank' href='<?php echo Sis::UrlBase() ?>"+e.val()+"/Acudiente/Ver'><i class='fa fa-eye'></i> "+e.html()+"</a></td>";
                var td_eliminar = "<td data='"+e.val()+"' class='x col-sm-1 text-center text-danger-icon'><a href='#' onClick='eliminar(this); return false;' href='#'><i class='fa fa-ban'></i></a></td>";
                $("#tab-acus").append("<tr>"+td_info_acu + td_eliminar+"</tr>");
                //$("#lis-acu").append("<li class='list-group-item' data='" + e.val() + "'><button class='btn btn-block btn-primary' onclick='eliminar(this)' type='button'><i class='fa fa-trash'></i> " + e.html() + "</button></li>");
                $("#form-deportistas").append("<input hidden='' name='Acudient[]' id='a" + e.val() + "' value='" + e.val() + "'>");
            } else if (acu_existe === 2) {
                lobiAlert("error","El Deportista ya tiene asociado este Acudiente");
            } else if (acu_existe === 3){
                lobiAlert("error","Ya se incluyo el Acudiente");
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
            /* validamos que el documento sea diferente de cero */
            if(valIdentificacion()){ return false; }

            if($.trim($("#Deportistas_telefono1").val()) == ""){ return false; }

            validarSubidaFoto();    
            if (validarAcudiente()) {
                if (validarDocumentos()) {
                    validarIdentificacion();                    
                }
            }
            return false;
        });
        // validamos la edad del deportista
        $("#Deportistas_fecha_nacimiento").change(function(){
            var edad = calcularEdad(new Date($(this).val()));
            var edadMax = <?= Configuracion::get("edad_max_deps"); ?>;
            if(parseInt(edad) < 6){
                lobiAlert("error", "El deportista no puede ser menor de 6 años");
                $("#btn-send").attr("disabled", "disabled");
                return false;
            } else if(edad > edadMax){
                lobiAlert("error", "El deportista no puede ser mayor de " + edadMax + " años");
                $("#btn-send").attr("disabled", "disabled");
                return false;
            } else {
                $("#btn-send").removeAttr("disabled");
            }
        });

    });

    /** 
     * Validamos que la identificación sea diferente de cero
     */
    function valIdentificacion(){
        var doc = $("#Deportistas_identificacion");
        if(doc.val() == '0'){
            doc.focus().select();
            lobiAlert("error", "Debe ingresar una identificación diferente de 0");
            return true;
        }
        return false;
    }

    function calcularEdad(birthday) { 
        var ageDifMs = Date.now() - birthday.getTime();
        var ageDate = new Date(ageDifMs); // miliseconds from epoch
        return Math.abs(ageDate.getUTCFullYear() - 1970);
    }
    
    function vnombredoc(e){ // Validar nombre del documento en actualizar
        if($(e).val() !== ""){
            var resp = validarNombreDocumento($.trim($(e).val().toLowerCase()));   
            if (resp > 1) {
                lobiAlert('error', 'Ya tienes un documento con ese nombre');
                $('#btn-send').attr("disabled", "disabled");                    
                $(e).focus();
            } else {
                validarNombreDoc($(e).val(), e);                
            }          
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
                    lobiAlert('error', 'El Deportista ya tiene un documento con ese nombre');
                    $('#btn-send').attr("disabled", "disabled");                    
                    $(e).focus();
                } else {
                    //lobiAlert('success', 'Nombre valido');
                    $('#btn-send').removeAttr("disabled");
                }
            }
        });
    }
    
    function valnombredoc(e){
        if($(e).val() !== ""){
            var resp = validarNombreDocumento($.trim($(e).val().toLowerCase()));                
            if (resp > 1) {
                lobiAlert('error', 'Ya tienes un documento con ese nombre');
                $('#btn-send').attr("disabled", "disabled");                    
                $(e).focus();
            } else {
                //lobiAlert('success', 'Nombre valido');
                $('#btn-send').removeAttr("disabled");
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
    
    function bonitoInputFile(){ // embellecer el file input documentos
        $("input[type=file]").fileinput({
            showPreview: false,
            showRemove: false,
            showUpload: false,
            browseLabel: "Seleccionar archivo",
            maxFileSize: 5000            
        });    
    }
    
    function encontrarAcu(val) { // ¿El Deportista ya esta asociado con el acudiente?
        var current_val = "", resp = 1;//existe = true;
        $("#tabla-acudientes td[val]").each(function (v, e) {
            current_val = e.getAttribute("val");
            if (current_val === val) {
                //existe = false;
                resp = 2;
            }
        });
        /* $("#lis-acu li[data]").each(function (v, e) {
            current_val = e.getAttribute("data");
            if (current_val === val) {
                existe = false;
            }
        }); */
        $("#tab-acus tr td.x[data]").each(function (v, e) {
            current_val = e.getAttribute("data");
            if (current_val === val) {
                //existe = false;
                resp = 3;
            }
        });
        //return existe;
        return resp;
    }
    
    function eliminar(e) { // Eliminar acudiente (aun no asociado al deportista) de la lista
        //var id_input_hidden = $(e).closest('li').attr('data');
        var id_input_hidden = $(e).closest('td').attr('data');
        $(e).closest('tr').remove();
        //$(e).closest('li').remove();
        $("#a" + id_input_hidden).remove();
    }
    
    function validarFecha(fecha) { // Validar rango de edad del deportista
        var anios = new Date(new Date - new Date(fecha.val())).getFullYear()-1970;       
        //console.log(anios);
        if (anios < 5 || anios > 17) { // edad valida: 6 a 16 años
            lobiAlert('error', 'Seleccione una fecha valida');
            $('#btn-send').attr("disabled", "disabled");
        } else {
            //lobiAlert('success', 'Fecha valida');
            $('#btn-send').removeAttr("disabled");
        }
    }
    
    function cambiarInformacionFoto(display, html, data){
        $("#fotos").attr("style", "display:" + display);
        $("#btn-cambiarFoto").html(html);
        $("#btn-cambiarFoto").attr("data", data);
    }
    
    function validarSubidaFoto(){
        if ($("#Deportistas_foto").val() !== "") {
            $("#change-foto").val("1");
        }
    }
    
    function activarCambioFoto(){
        var invisible = $("#btn-cambiarFoto").attr("data");
        if (invisible === "0") { // mostrar
            cambiarInformacionFoto("true", "Cancelar", "1");            
        }else{ // ocultar
            cambiarInformacionFoto("none", "Cambiar foto", "0");                        
            $("#Usuarios_foto").val("");            
            $(".file-caption-name").html("");                        
        }
    }
    
    function validarAcudiente(){ // Validar que este asociado como minimo un acudiente o
        var resp = true;           // se vaya a asociar uno (lista de acudientes nuevos) 
        //var x = $('#lis-acu li').length;
        var x = $('#tab-acus tr').length;
        var y = $('#tabla-acudientes tr').length;
        //console.log(x,y);
        if (x < 1 && y === 0) {
            resp = false;
            lobiAlert('error', 'El Deportista debe contar mínimo con un Acudiente');   
        }
        return resp;
    }
</script>
