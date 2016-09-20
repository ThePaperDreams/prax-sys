<?php 
Sis::Recursos()->registrarRecursoJS(['url' => Sis::UrlRecursos() . 'librerias/thumbnailsScroller/jquery.mThumbnailScroller.js']);
Sis::Recursos()->registrarRecursoCSS(['url' => Sis::UrlRecursos() . 'librerias/thumbnailsScroller/jquery.mThumbnailScroller.css']);
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
                        cargar
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
        $("#add-gallery").click(function(){
            addGallery();
        });
        $("#btn-set-imgs").click(function(){
            setImagesToGallery();
        });
    });
    
    function setImagesToGallery(){
        var images = $(".thumb-pic-gallery.active");
        var gallery = $("#galeria-" + galeriaActual);
        var cont = gallery.find(".thumbs-list ul");
        images.each(function(k,v){
            var currImg = $(v);
            var link = $("<a/>", {href:'#'});
            var input = $("<input/>", {type: 'hidden', name:'galerias[' + galeriaActual  + '][imagenes][]'});
            var img = $("<img/>", {src:currImg.attr("data-thumb-url"), class: 'thumb-pic'});
            var li = $("<li/>", { class: 'mTSThumbContainer'});
            input.val(currImg.attr("data-id"));
            link.append(img);
            li.append(link, input);
            cont.append(li);
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
        
        var contenedorGalerias = $("#galleries-container");
        contenedorGalerias.append(galeria);
        
        galerias ++;
    }
    
    
    </script>