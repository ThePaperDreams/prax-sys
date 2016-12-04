<?php 
Sis::Recursos()->recursoCss([
    'url' => Sis::urlRecursos() . 'librerias/boot-file-input/css/fileinput.min.css',
]);
Sis::Recursos()->recursoJs([
    'url' => Sis::urlRecursos() . 'librerias/boot-file-input/js/fileinput.min.js',
]);
$formulario = new CBForm(['id' => 'form-matriculas', 'opcionesHtml' => ['enctype' => 'multipart/form-data']]);
$formulario->abrir();
?>
<div class="tile p-15">
    <p>Los campos con <span class="text-danger">*</span>  son requeridos</p>
    <hr>
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            Información de la matricula
        </div>
        <div class="panel-body">
            <div class="form-group">                
                <label class="control-label">Matriculados: <span id="cat-data" class="label label-default">0 / 0</span></label>
                <p><label class="control-label">Edades: <span id="cat-edades"></span></label></p>
                <?php echo $formulario->lista($modelo, 'categoria_id', $categorias, ['defecto' => 'Seleccionar una categoría']) ?>
            </div>
            <div class="form-group" id="lista-container" style="display:none;">
                <div class="alert alert-info">
                    ¿No hay cupos disponibles en esta categoría, desea enviar el deportista a lista de espera?
                </div>
                <a href="<?= Sis::CrearUrl(['matricula/listaDeEspera']) ?>" class="btn btn-success btn-block">
                    Enviar a lista de espera
                </a>
            </div>
            <div id="otros-campos-container">
                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" id="flag-dep" value="0">
                        <?php echo $formulario->lista($modelo, 'deportista_id', $deportistas, ['label' => true, 'group' => true, 'defecto' => 'Seleccione un deportista']) ?>
                    </div>
                    <div class="col-sm-7">
                        <input type="hidden" id="flag-dep" value="0">
                        <div class="col-sm-8">
                            <?php echo $formulario->lista($modelo, 'club_id', $clubes, ['label' => true, 'group' => true, 'defecto' => 'Seleccione un club']) ?>
                        </div>
                        <div class="col-sm-4">
                            <label for="">&nbsp;</label>
                            <button class="btn btn-block btn-primary" id="button-add-club">
                                Nuevo club
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <?php echo $formulario->inputAddon($modelo, 'fecha_pago', 'text', ['label' => true, 'readonly' => true, 'group' => true, 'class' => 'campo-fecha', 'data-val-maxmin' => true, 'data-only-min' => true], ['pos' => CBoot::fa('calendar')]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <?php echo $formulario->campoArchivo($modelo, 'url_comprobante', ['label' => true, 'group' => true]) ?>            
                    </div>
                </div>                
            </div>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-sm-offset-6 col-sm-3">
                    <?php echo CHtml::link(CBoot::fa('undo').' Cancelar', ['matricula/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
                </div>
                <div class="col-sm-3">
                    <?php echo CBoot::boton(CBoot::fa('save') .' '. ($modelo->nuevo? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block', 'id' => 'btn-send']); ?>
                </div>
            </div>        
        </div>
    </div>
</div>

<?php if (isset($this->_g['id'])): ?>
    <input type="hidden" name="id_lista_espera" value="<?= $this->_g['id'] ?>">
<?php endif ?>

<?php $formulario->cerrar(); ?>

<div class="modal fade" id="modal-clubes">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Gestionar clubes</h4>
            </div>
            <div class="modal-body">
                
                <ul class="nav nav-tabs" role="tablist">
                    <li disabled="disabled" role="presentation" class="active"><a href="#registrar" aria-controls="registrar" role="tab" data-toggle="tab">Registrar club</a></li>
                    <li disabled="disabled" role="presentation"><a href="#gestionar" aria-controls="gestionar" role="tab" data-toggle="tab">Gestionar clubes</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="registrar">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Nombre</label>
                                <?= CBoot::text('', ['id' => 'club_nombre']) ?>
                            </div>                            
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Teléfono</label>
                                <?= CBoot::text('', ['id' => 'club_telefono']) ?>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Dirección</label>
                                <?= CBoot::text('', ['id' => 'club_direccion']) ?>
                            </div>                            
                        </div>
                        <hr>
                        <br>
                        <div class="form-group">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button id="btn-guardar-club" type="button" class="btn btn-success">Guardar <i class="fa fa-floppy-o"></i></button>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="gestionar">
                        <table class="table table-hover" id="tabla-clubes">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Dirección</th>
                                    <th>Teléfono</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($mClubes as $club): ?>
                                <tr data-id="<?= $club->id ?>">
                                    <td><?= $club->nombre ?></td>
                                    <td><?= $club->direccion ?></td>
                                    <td><?= $club->telefono ?></td>
                                    <td>
                                        <!-- <button class="btn-primary btn btn-edit">
                                            <i class="fa fa-pencil"></i>
                                        </button> -->
                                        <button class="btn-danger btn btn-delete-club">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>

<script>

    function guardarClub(){
        var nombre = $("#club_nombre");
        var telefono = $("#club_telefono");
        var direccion = $("#club_direccion");        

        if($.trim(nombre.val()) == ""){
            lobiAlert("error", "Debe ingresar un nombre al club");
            nombre.focus();
            return false;
        }

        $.ajax({
            type : 'POST',
            url  :  '<?= Sis::crearUrl(["matricula/ajax"]) ?>', 
            data : {
                ajx: true,
                type: "guardar-club",
                nombre: nombre.val(),
                telefono: telefono.val(),
                direccion: direccion.val(),
            }
        }).done(function(data){
            if(data.error == false){
                lobiAlert("success", "Se guardó correctamente el nuevo club");
                $("#modal-clubes").modal("hide");

                var select = $("#Matriculas_club_id");
                select.select2("destroy");
                var op = $("<option/>", {value: data.club_id}).html(data.nombre);

                select.append(op);
                select.select2({
                    width: "100%",
                });

                var icon = $("<i/>", {class: 'fa fa-trash'});
                var button = $("<button/>", {class: 'btn btn-danger'});
                button.append(icon);

                var tr = $("<tr/>", {'data-id' : data.club_id});
                tr.append($("<td/>").html(nombre.val()));
                tr.append($("<td/>").html(direccion.val()));
                tr.append($("<td/>").html(telefono.val()));
                tr.append($("<td/>").append(button));

                $("#tabla-clubes").find("tbody").append(tr);

                button.click(function(){
                    var tr = $(this).closest("tr");
                    confirmar("Confirmar", "¿Seguro desea remover este club?", function(){
                        borrarclub(tr.attr("data-id"));
                    });
                });
                
                select.select2("open");
                nombre.val("");
                telefono.val("");
                direccion.val("");         

            } else if(data.error == true){
                lobiAlert("error", data.msg);
            }else {
                console.log(data);
            }
        });

    }

    function borrarclub(id){
        ajax(1, id);
    }

    function editarClub(){

    }

    function ajax(tipo, id){
        $.ajax({
            type : 'POST',
            url  :  '<?= Sis::crearUrl(["matricula/ajax"]) ?>', 
            data: {
                ajx: true,
                type: "editar-eliminar",
                "r-type" : tipo,
                id: id,
            }
        }).done(function(data){
            if(data.error == false){
                lobiAlert("success", data.msg);
                var tr = $("tr[data-id='" + id + "']");
                tr.find("td").slideUp(function(){
                    tr.remove();
                });

                var select = $("#Matriculas_club_id");
                select.select2("destroy");
                select.find("option[value='" + id + "']").remove();
                select.select2({width: '100%'});

            } else if(data.error == true){
                lobiAlert("error", data.msg);
            } else {
                console.log(data);
            }
        });
    }

    jQuery(function(){

        $(".btn-edit").click(function(){
            editarClub($(this).parent().attr("data-id"));
        });

        $(".btn-delete-club").click(function(){
            var tr = $(this).closest("tr");
            confirmar("Confirmar", "¿Seguro desea remover este club?", function(){
                borrarclub(tr.attr("data-id"));
                // var id = $(this).closest("td").attr("data-id");
                // alert(id);
                // borrarclub($(this).parent().attr("data-id"));
            });
            return false;
        });

        $("#btn-guardar-club").click(function(){
            guardarClub();
            return false;
        });

        $("#button-add-club").click(function(){
            $("#modal-clubes").modal("show");
            setTimeout(function(){
                $("#club_nombre").focus();
            }, 400);
            return false;
        });

        jQuery("#form-matriculas").submit(function(){
            if(jQuery("#Matriculas_categoria_id").val() == ""){
                jQuery("#Matriculas_categoria_id").select2("open");
                return false;
            }
            if(!__validar_form__()){ return false; }

            var table = $("<table/>", {class: 'table table-bordered table-hover'});
            var categoria = $("#Matriculas_categoria_id option:selected").html();
            var club = $("#Matriculas_club_id option:selected").html();
            var dep = $("#Matriculas_deportista_id option:selected").html().split("-");
            var nombre = dep[1].split('(');

            var p = $("<p/>").html("¿Realmente desea matricular a " + nombre[0] + "?");

            table.append($("<tr/>").append($("<th/>").html("Categoría: "), $("<td/>").html(categoria)));
            table.append($("<tr/>").append($("<th/>").html("Club: "), $("<td/>").html(club)));

            Lobibox.confirm({
                title: 'Confirmar',
                msg: p[0].outerHTML + table[0].outerHTML,
                buttons: {
                    yes: {class: 'btn btn-success', text: 'Si'},
                    no: {class: 'btn btn-default', text: 'No'},
                },
                callback: function($this, type, evt){
                    if(type == 'yes'){
                        document.getElementById("form-matriculas").submit();
                    } else {
                        
                    }
                }
            });
            return false;
        });
        
        jQuery("#Matriculas_deportista_id, #Matriculas_categoria_id").select2({
            width: "100%",
        });
        
        setTimeout(function(){
            jQuery("#Matriculas_categoria_id").select2('open');
        }, 100);        
        
        jQuery("#Matriculas_url_comprobante").fileinput({
            showPreview: false,
            showRemove: false,
            showUpload: false,
            browseLabel: "Seleccionar archivo",
        });
        jQuery("#Matriculas_deportista_id").change(function(){
            if(jQuery(this).val() === ""){
                $("#flag-dep").val("0");
                $("#btn-send").attr("disabled", "disabled");
            } else {                
                doAjax(1, jQuery(this).val());
            }
        });
        jQuery("#Matriculas_categoria_id").change(function(){
            if(jQuery(this).val() === ""){
                $("#btn-send").attr("disabled", "disabled");
            } else {                
                doAjax(2, jQuery(this).val());
            }
        });
    });
    
    var error = false;
    
    function doAjax(type, id){
        jQuery.ajax({
            url: "<?= Sis::crearUrl(['matricula/validar']) ?>",
            type: "post",
            data: {
                ajx:true,
                type: type,
                id: id,
            },
            success: function(r){
                if(r.error == true && type === 1){
                    $("#flag-dep").val("0");
                    mostrarLobi(r.msg);
                } else if(type === 1) {
                    $("#flag-dep").val("1");
                }
                var errCat = false;
                if(type === 2){
                    var matriculados = parseInt(r.datos.matriculados);
                    var max = parseInt(r.datos.max);
                    var span = $("#cat-data");
                    span.html( matriculados + " / " + max);
                    $("#cat-edades").html(r.datos.edades);

                    consultarDeportistas(r.datos.emin, r.datos.emax);

                    if(matriculados >= max){
                        /*no hay cupos*/
                        mostrarLobi("La categoría seleccionada no tiene cupos.");
                        $("#lista-container").slideDown();
                        $("#otros-campos-container").slideUp();
                        span.attr("class", "label label-danger");
                        errCat = true;
                    } else if(matriculados >= (max / 2)){
                        span.attr("class", "label label-warning");                        
                        $("#lista-container").slideUp();
                        $("#otros-campos-container").slideDown();
                    } else {
                        span.attr("class", "label label-success");
                        $("#lista-container").slideUp();
                        $("#otros-campos-container").slideDown();
                    }
                }
                
                if($("#flag-dep").val() == 1 && !errCat){
                    $("#btn-send").removeAttr("disabled");
                } else {
                    $("#btn-send").attr("disabled", "disabled");
                }
            }
        });
    }

    function consultarDeportistas(min, max){
        $.ajax({
            type    :  'POST',
            url     : '<?= Sis::crearUrl(['matricula/ajax']); ?>',
            data    : {
                ajx : true,
                type: 'deportistas',
                min : min,
                max : max,
            }
        }).done(function(data){
            if(data.error == false){
                var combo = $("#Matriculas_deportista_id");
                combo.select2("destroy");
                combo.html(data.ops);
                combo.select2({ width: '100%'});
                combo.select2("open");
            } else {
                lobiAlert("error", "Error al consultar");
            }
        });
    }
    
    function mostrarLobi(msg){
        Lobibox.notify("error",{
            size: 'mini',
            showClass: 'bounceInRight',
            hideClass: 'bounceOutRight',
            msg:msg,
            delay: 8000,
            soundPath: '<?= Sis::UrlRecursos() ?>librerias/lobibox/sounds/',
        });
    }
</script>

<?php if (isset($this->_g['id'])): ?>
    <script>
        $(function(){
            var dep = $("#Matriculas_deportista_id");
            var cat = $("#Matriculas_categoria_id");

            setTimeout(function(){
                cat.select2("destroy");
                cat.val(<?= $this->_g['c'] ?>);
                cat.select2({width: '100%'});
                cat.change();
            }, 100);

            setTimeout(function(){
                dep.select2("destroy");
                dep.val(<?= $this->_g['d'] ?>);
                dep.select2({width: '100%'});
                dep.change();

            }, 1000);
        });
    </script>
<?php endif ?>