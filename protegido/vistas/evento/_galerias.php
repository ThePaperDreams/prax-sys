<?php 

Sis::Recursos()->registrarRecursoJS(['url' => Sis::UrlRecursos() . 'librerias/thumbnailsScroller/jquery.mThumbnailScroller.js']);
Sis::Recursos()->registrarRecursoCSS(['url' => Sis::UrlRecursos() . 'librerias/thumbnailsScroller/jquery.mThumbnailScroller.css']);
Sis::Recursos()->recursoCss(['url' => Sis::urlRecursos() . 'librerias/boot-file-input/css/fileinput.min.css']);
Sis::Recursos()->recursoJs(['url' => Sis::urlRecursos() . 'librerias/boot-file-input/js/fileinput.min.js']);

?>
<div class="row">
    <div class="col-sm-6">
        <?= CBoot::text('', ['placeholder' => 'Nombre para la galería', 'id' => 'nombre-galeria', 'label' => 'Nombre de la galería', 'group' => true]) ?>        
    </div>
    <div class="col-sm-6">
        <label>&nbsp;</label>
        <div class="form-group">
            <?= CBoot::boton('Agregar ' . CBoot::fa('plus'),'default btn-block', ['id' => 'add-gallery']) ?>                        
        </div>
    </div>
    
    <hr>
    
    <div id="galleries-container" class="col-sm-12">       
        
    </div>
    
</div>

<div class="modal fade modal-wide" id="modal-add-imgs">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Imagenes</h4>
            </div>
            <div class="modal-body">
                
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#listar-imagenes" aria-controls="listar-imagenes" role="tab" data-toggle="tab">Listado</a></li>
                    <li role="presentation"><a href="#cargar-imagenes" aria-controls="cargar-imagenes" role="tab" data-toggle="tab">Cargar</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="listar-imagenes">
                        <?= $this->vistaP('_imagenes', ['imagenes' => $imagenes]) ?>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="cargar-imagenes">
                        <div class="form-group">
                            <input type="file" name="imagenes" id="input-cargar-imagen" multiple="">
                        </div> 
                    </div>
                </div>
                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success" data-dismiss="modal" id="btn-set-imgs">Añadir imagenes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

    <script>
    (function($){
            $(window).load(function(){
                $(".thumbs-list").mThumbnailScroller({
                    type:"click-50",
                    theme:"buttons-in"
                });
            });
        })(jQuery);
    
    var galerias = 1;
    var galeriaActual = 0;
    
    $(function(){
        
        $("#input-cargar-imagen").fileinput({
            uploadUrl: "<?= Sis::crearUrl(['publicacion/ajx']) ?>",
            uploadAsync: true,
            maxFileCount : 5,
            language: 'es',
            uploadExtraData: {
                'upload-imgs': true,
            }
        }).on('fileuploaded', function(event, data, id, index){
            console.log(data.response);
            var respuesta = data.response;
            if(respuesta.uploadErr === false){
                console.log(respuesta.url);
                addThumb(respuesta);
            }                
        });
        
        $("#add-gallery").click(function(){
            addGallery();
            return false;
        });
        $("#btn-set-imgs").click(function(){
            setImagesToGallery();
            $("#modal-add-imgs").modal('hide');
            return false;
        });
    });
    
    function addThumb(obj){
        var cont = $("#listar-imagenes");
        var img = $("<img/>", { class:'pic-to-add', src: obj.url});
        var div = $("<div/>", { class: 'thumb-pic-gallery', "data-id" : obj.id, 'data-real-url' : obj.urlReal, 'data-thumb-url' : obj.url});
        div.append(img);
        div.click(function(){
            checkImg($(this));
        });
        cont.prepend(div);
    }
    
    function checkImg(cont){
        if(cont.hasClass("active")){
            cont.removeClass("active");
        } else {
            cont.addClass("active");
        }
    }
    
    function setImagesToGallery(){
        var images = $(".thumb-pic-gallery.active");
        var gallery = $("#galeria-" + galeriaActual);
        var cont = gallery.find(".thumbs-list ul");
        images.each(function(k,v){
            var currImg = $(v);
            var link = $("<a/>", {href:'#'});
            var input = $("<input/>", {type: 'hidden', name:'galerias[' + galeriaActual  + '][imagenes][]'});
            var img = $("<img/>", {src:currImg.attr("data-thumb-url"), class: 'thumb-pic'});
            var li = $("<li/>", { class: 'mTSThumbContainer thumb-gallery'});
            var iconTrash = $("<i/>", { class: 'fa fa-trash'});
            var buttonDel = $("<button/>", { class: "btn btn-danger btn-del-img-gallery"});
            /* funciones */
            var borrarThumb = function(){
                li.fadeOut(function(){
                    li.remove();
                });
            };
            
            buttonDel.append(iconTrash);
            input.val(currImg.attr("data-id"));
            link.append(img);
            li.append(link, input, buttonDel);
            cont.append(li);
            currImg.removeClass("active");
            buttonDel.click(function(){
                borrarThumb();
                return false;
            });
        });
        if(gallery.attr("data-is-gallery") === undefined){
            $("#thumb-list-" + galeriaActual).mThumbnailScroller({
                type:"click-50",
                theme:"buttons-in"
            });            
        }
    }
    
    function removeGallery(id){
        var galeria = $("#galeria-" + id);
        galeria.slideUp(function(){
            galeria.remove();
        });
    }
    
    function addGallery(){
        var tituloGaleria = $("#nombre-galeria");
        
        if($.trim(tituloGaleria.val()) === ""){
            lobiAlert("error", "Ingrese un nombre para la galería");
            tituloGaleria.focus();
            return;
        }
        
        var ul = $("<ul/>");
        var thumbList = $("<div/>",  { class: 'thumbs-list', id:'thumb-list-' + galerias });
        var iconButton = $("<i/>", { class: 'fa fa-plus' });
        var button = $("<button/>", { class: 'btn btn-default', "data-gallery-id" : galerias});
        var buttonGrp = $("<div/>", { class: 'text-center button' });
        var photosDiv = $("<div/>", { class: 'photos' });
        var title = $("<div/>", { class: 'title' });
        var iconRemove = $("<i/>", { class: 'fa fa-trash' });
        var btnRemove = $("<button/>", { class: 'btn btn-danger', "data-gallery-id" : galerias });
        var galeria = $("<div/>", { class: 'gallery', id: 'galeria-' + galerias });
        var input = $("<input/>", { type:'hidden', 'name' : 'galerias[' + galerias + '][nombre]' });
        input.val(tituloGaleria.val());
        
        button.click(function(){ 
            $("#modal-add-imgs").modal('show');
            galeriaActual = $(this).attr("data-gallery-id");            
        });
        
        btnRemove.click(function(){
            removeGallery($(this).attr("data-gallery-id"));
        });
        
        thumbList.append(ul);
        button.html("Agregar imagenes ");
        button.append(iconButton);
        buttonGrp.append(button);
        photosDiv.append(thumbList, buttonGrp);
        btnRemove.append(iconRemove);
        title.html(tituloGaleria.val());
        title.append(btnRemove);
        galeria.append(title, photosDiv);
        galeria.append(input);
        
        button.click(function(){ return false; });
        
        var contenedorGalerias = $("#galleries-container");
        contenedorGalerias.append(galeria);
        
        galerias ++;
    }
    
    
    </script>