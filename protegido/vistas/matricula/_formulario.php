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
                    <div class="col-sm-6">
                        <input type="hidden" id="flag-dep" value="0">
                        <?php echo $formulario->lista($modelo, 'club_id', $clubes, ['label' => true, 'group' => true, 'defecto' => 'Seleccione un club']) ?>
                    </div>
                    <div class="col-sm-6">
                        <?php echo $formulario->inputAddon($modelo, 'fecha_pago', 'text', ['label' => true, 'readonly' => true, 'group' => true, 'class' => 'campo-fecha'], ['pos' => CBoot::fa('calendar')]) ?>
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
<script>
    jQuery(function(){
        jQuery("#form-matriculas").submit(function(){
            if(jQuery("#Matriculas_categoria_id").val() == ""){
                jQuery("#Matriculas_categoria_id").select2("open");
                return false;
            }
            return true;
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