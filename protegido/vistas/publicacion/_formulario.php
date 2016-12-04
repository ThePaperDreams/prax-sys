<?php
Sis::Recursos()->RecursoJS(['url' => Sis::Recursos()->getUrlRecursos().'librerias/tinyMce/tinymce.js']);
Sis::Recursos()->RecursoJS(['url' => Sis::apl()->tema->getUrlBase() . '/js/pirobox.min.js']);

Sis::Recursos()->recursoCss(['url' => Sis::urlRecursos() . 'librerias/boot-file-input/css/fileinput.min.css']);
Sis::Recursos()->recursoJs(['url' => Sis::urlRecursos() . 'librerias/boot-file-input/js/fileinput.min.js']);
Sis::Recursos()->recursoJs(['url' => Sis::urlRecursos() . 'librerias/boot-file-input/js/fileinput_locale_es.js']);

$formulario = new CBForm(['id' => 'form-publicaciones']);
$formulario->abrir();
?>
<div class="tile p-15">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#listar" aria-controls="listar" role="tab" data-toggle="tab">Publicación</a></li>
        <li role="presentation"><a href="#cargar" aria-controls="cargar" role="tab" data-toggle="tab">Imagenes</a></li>
    </ul>
     <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="listar">
            <div class="col-sm-6">
              <label>Tipos de Publicación</label>
                <?php echo $formulario->lista($modelo, 'tipo_id', $public, ['data-s2' => true]) ?>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Estado</label>
                    <?php echo $formulario->lista($modelo, 'estado_id', $estd, ['data-s2' => true]) ?>
                </div>    
            </div>
            <div class="col-sm-6">
                    <div class="form-group">
                        <?php echo $formulario->inputAddon($modelo, 'fecha_disponibilidad','texto', ['data-val-maxmin' => true, 'readonly' => true, 'label' => true, 'group' => true, 'class' => 'campo-fecha', 'id'=>'calendar' ],['pos' => CBoot::fa('calendar-check-o', ['class' => 't-calendar', 'data-t' => '#calendar'])]) ?>   
                    </div>    
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">Resumen <span id="total-chars">0</span>/<span id="max-chars">150</span> </label>
                    <?php echo $formulario->areaTexto($modelo, 'resumen', [ 'maxlength' => 150]) ?>
                </div>
            </div>
            <div class="col-sm-6">
                <?php echo $formulario->inputAddon($modelo, 'titulo', 'texto', ['maxlength' => 100, 'label' => true, 'group' => true, 'autofocus' => true], 'font') ?>
            </div>
            <div class="col-sm-6">
                <?php echo $formulario->inputAddon($modelo, 'img_previsualizacion', 'texto', ['readonly' => true, 'maxlength' => 200, 'label' => true, 'group' => true, 'autofocus' => true], ['pos' => CBoot::fa('picture-o', ['id' => 'open-modal-img', 'class' => 'pointer'])]) ?>
            </div>
            <div class="col-sm-12">
                <?php echo $formulario->areaTexto($modelo, 'contenido', ['label' => true, 'group' => true, 'class' => 'summernote', 'rows' => 15]) ?>
            </div>
        </div>    
        <div role="tabpanel" class="tab-pane" id="cargar">
            <div class="row" id="tab-imagenes">
                
                <?= $this->vistaP('gestorImagenes', ['imagenes' => $imagenes]) ?>
                
            </div>    
        </div>        
        <div class="row">
            <div class="col-sm-offset-6 col-sm-3">
                <?php echo CHtml::link(CBoot::fa('undo') . ' Cancelar', ['publicacion/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
            </div>
            <div class="col-sm-3">
                <?php echo CBoot::boton(CBoot::fa('save') . ' ' . ($modelo->nuevo ? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block']); ?>
            </div>
        </div> 
    </div>
</div>    

<!-- <div class="modal fade modal-wide" id="modal-imgs">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Imagenes</h4>
            </div>
            <div class="modal-body">
                
                <?php foreach ($imagenes as $imagen): ?>
                <div class="img-pre">
                    <img src="<?= Sis::UrlBase() . "publico/imagenes/galerias/thumbs/tmb_" . $imagen->url ?>" alt="" width="150">    
                    <div class="input-group">        
                        <button class="btn btn-primary btn-block add-img-button" data-real-url="<?= Sis::UrlBase() . "publico/imagenes/galerias/" . $imagen->url ?>">
                            Usar <fa class="fa fa-hand-pointer-o"></fa>
                        </button>
                    </div>
                </div>
                <?php endforeach ?>

               <div class="row">
                    <div class="col-sm-12" id="img-list-1">
                    
                    </div>
                    <div class="col-sm-6 text-center" id="img-pre-add-1" style="display: none;">
                        <img src="" id="preview-img-add-1" alt="">
                        <div class="row">
                            <div class="col-sm-offset-4 col-sm-4 p-15">
                                
                                <button class="btn btn-primary btn-block" id="insert-img">Insertar esta imagen</button>
                            </div>
                        </div>
                    </div>
               </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div> -->

<div class="modal fade modal-wider" id="moda-use-img">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Seleccionar imagen</h4>
            </div>
            <div class="modal-body">
               <div class="row">
                    <div class="col-sm-12" id="img-list">
                    
                    </div>
                    <div class="col-sm-6 text-center" id="img-pre-add" style="display: none;">
                        <img src="" id="preview-img-add" alt="">
                        <div class="row">
                            <div class="col-sm-offset-4 col-sm-4 p-15">
                                
                                <button class="btn btn-primary btn-block" id="insert-img">Insertar esta imagen</button>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button> 
            </div>
        </div>
    </div>
</div>

<script>
    
    $(document).ready(function() {

        $("#open-modal-img").click(function(){
            $("#modal-imgs").modal('show');
            return false;
        });

        $("#insert-img").click(function(){
            var img = $("#preview-img-add");
            var target = $("#" + img.attr("data-target"));
            target.val(img.attr("src"));
            $("#moda-use-img").modal("hide");
            return false;
        });

        $(".add-img-button").click(function(){
            var url = $(this).attr("data-real-url");
            $("#Publicaciones_img_previsualizacion").val(url);
            $("#modal-imgs").modal("hide");
            return false;
        });

        $("#Publicaciones_resumen").keydown(function(e){
            var t = $(this);
            var max = parseInt($("#max-chars").html());
            $("#total-chars").html(t.val().length);
            if(t.val().length >= max && ( e.which != 8 && e.which !== 116)){
                e.preventDefault();
                return false;
            }
        });
//        $("#Publicaciones_img_previsualizacion").fileinput({
//            showPreview: false,
//            showUpload: false,
//            showRemove: false,
//            browseLabel: "Buscar"
//        });
        
        tinymce.init({
            selector: '#Publicaciones_contenido',
            language : 'es',
            plugins: "code,image,pagebreak,advlist,fullscreen,imagetools,link,media,paste,textcolor,wordcount,example,",
            image_advtab: true,
            image_prepend_url: "<?php echo Sis::UrlBase() ?>/imagenes/articulos",
            link_assume_external_targets: true,
            // file_browser_callback : 'openImageGallery',
            file_browser_callback : function(field_name, url, type, win){
                // $("#" + field_name).val("wolas");
                openImageGallery(field_name);
            },
        });
        
    $("#calendar").change(function(){
            validarFecha($(this));
        });
    });

    function openImageGallery(inputName){
        var modal = $("#moda-use-img");
        fetchImgs(modal.find(".modal-body #img-list"), inputName);
        modal.modal("show");
    }   

    function fetchImgs(appendBody, inputName){
        $.ajax({
            type: 'POST',
            url: '<?= Sis::crearUrl(['publicacion/ajax']) ?>',
            data: {
                ajx : true,
                type: 'query_imgs',
            },
        }).done(function(data){
            if(data.error == false){
                appendBody.html("");
                $.each(data.imgs, function(k,v){
                    var imgcont = $("<div/>", {'class' : 'img-container'}); 
                    imgcont.attr("data-url", v.url);

                    var img = $("<img/>", { src : v.thumb, 'width' : '100px', "data-url" : v.url, "data-target" : inputName});
                    imgcont.append(img);                    

                    imgcont.click(function(){
                        $("#img-list").removeClass("col-sm-12")
                            .addClass("col-sm-6");
                        $("#preview-img-add").attr("src", v.url);
                        $("#preview-img-add").attr("data-target", inputName);
                        $("#img-pre-add").slideDown();
                    });

                    appendBody.append(imgcont);
                });
            }
        });
    }
 
 function validarFecha(fecha) {
        var d = new Date();
        var fechaActualStr = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + (d.getDate() < 10? '0' : '') + d.getDate();
        var currDate = Date.parse(fechaActualStr);
        var date = Date.parse(fecha.val());

        if (date  > currDate) {
            $('#btn-send').removeAttr("disabled");
        } else {
            mostrarAlert("error", "Seleccione una fecha mayor a la de hoy");
            $('#btn-send').attr("disabled", "disabled");
        }
    }

 $(function(){
        $("#form-publicaciones").submit(function(){
            validarNombre();
            return false;
        });
    });  
    
    function validarNombre() {
        var nombre = $("#Publicaciones_titulo").val();
        if (nombre === "") {
            return;
        }

        $.ajax({
            type: 'POST',
            url: '<?= $url ?>',
            data: {
                validarNombre: true,
                nombre: nombre,
            },
            success: function (respuesta) {
                if (respuesta.error == true) {
                    mostrarAlert("error", "Ya existe una publicación con ese título");
                } else {
                    setTimeout(function(){
                        if($("#Publicaciones_contenido").val() == ""){
                            confirmar("Confirmar envio", "¿Realmente desea guardar sin contenido?", function(){
                                document.getElementById("form-publicaciones").submit();
                            });
                        } else {
                            document.getElementById("form-publicaciones").submit();
                        }

                    }, 300);
                }
            }
        });
    }

    function mostrarAlert(tipo, msg) {
        lobiAlert(tipo, msg);
        // Lobibox.notify(tipo, {
        //     size: 'mini',
        //     showClass: 'bounceInRight',
        //     hideClass: 'bounceOutRight',
        //     msg: msg,
        //     delay: 8000,
        //     soundPath: '<?= Sis::UrlRecursos() ?>librerias/lobibox/sounds/',
        // });
    }
    
</script>

<?php $formulario->cerrar(); ?>