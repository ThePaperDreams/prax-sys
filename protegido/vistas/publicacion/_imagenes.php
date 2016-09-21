<div class="row">
    <div class="col-sm-12">
        <button class="btn btn-primary" id="open-modal">
            <i class="fa fa-upload"></i> 
            Cargar Imagenes
        </button>        
    </div>
</div>
<hr>
<div id="img-container">
    
<?php foreach ($imagenes AS $imagen): ?>
    <div id="rep-img-<?= $imagen->id_imagen ?>" class="img-pre">
        <img src="<?= Sis::UrlBase() . "publico/imagenes/galerias/thumbs/tmb_" . $imagen->url ?>" alt="" width="150">    
        <button class="btn btn-danger btn-eliminar" data-id="<?= $imagen->id_imagen ?>">
            <i class="fa fa-trash"></i>
        </button>
        <div class="input-group">        
            <input type="text" class="form-control input-url" value="<?= Sis::UrlBase() . "publico/imagenes/galerias/" . $imagen->url ?>">
            <div class="protector"></div>
            <div class="input-group-addon">
                <i class="fa fa-clipboard img-copy" title="Seleccionar url"></i>
            </div>
        </div>
    </div>
<?php endforeach ?>
</div>

<div class="modal fade modal-wide" id="modal-add-imgs">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cargar imagenes</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <input type="file" name="imagenes" id="cargar-imagen" multiple="">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    var ctrlDown = false;
    $(function () {
        $(".img-copy").click(function () {
            var input = $(this).closest(".input-group").find("input");
            input.focus().select();
            input.keydown(function(e){ 
                if(e.keyCode === 17 || e.keyCode === 91){ ctrlDown = true; }
                if(ctrlDown && e.keyCode === 67){ return true; }
                e.preventDefault();
            }).keyup(function(e){
                if(e.keyCode === 17 || e.keyCode === 91){ ctrl = false; }
            });
        });
        $("#open-modal").click(function () {
            $("#modal-add-imgs").modal('show');
            return false;
        });
        
        $(".btn-eliminar").click(function(){
            eliminarImagen($(this).attr("data-id"));
        });
        
        $("#cargar-imagen").fileinput({
            uploadUrl: "<?= Sis::crearUrl(['publicacion/ajx']) ?>",
            uploadAsync: true,
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
        
    });
    function addThumb(obj){
        var img = $("<img/>", {src: obj.url});
        var iconTrash = $("<i/>", { class: 'fa fa-trash'});
        var button = $("<button/>", {class: 'btn btn-danger btn-eliminar', 'data-id' : obj.id});
        var input = $("<input/>", {type:'text', 'class' : 'form-control input-url'});
        var protector = $("<div/>", {class:'protector'});
        var icon = $("<i/>", {class:'fa fa-clipboard img-copy', title: 'Seleccionar url'});
        var addon = $("<div/>", {class:'input-group-addon'});
        var inGroup = $("<div/>", {class: 'input-group'});
        var container = $("<div/>", {class: 'img-pre', 'id' : 'rep-img-' + obj.id});
        
        button.append(iconTrash);
        addon.append(icon);
        inGroup.append(input, protector, addon);
        container.append(img, button, inGroup);
        input.val(obj.urlReal);
        
        button.click(function(){
            eliminarImagen($(this).attr("data-id"));
        });
        
        icon.click(function(){
            var input = $(this).closest(".input-group").find('input');
            input.focus().select();
        });
        input.keydown(function(e){ 
            if(e.keyCode === 17 || e.keyCode === 91){ ctrlDown = true; }
            if(ctrlDown && e.keyCode === 67){ return true; }
            e.preventDefault();
        }).keyup(function(e){
            if(e.keyCode === 17 || e.keyCode === 91){ ctrl = false; }
        });
        $("#img-container").prepend(container);
    }
    
    function eliminarImagen(id){
        var msg = "¿Seguro que desea borrar esta imagen? Al hacerlo la imagen desaparecerá de cualquier publicación en que se encuentre ¿desea continuar? ";
        if(!confirm(msg)){
            return false;
        }
        $.ajax({
            'type' : 'POST',
            'url' : '<?= Sis::crearUrl(['publicacion/ajx']) ?>',
            data: {
                'delete-img' : true,
                'id' : id,
            },
            success: function(obj){
                if(obj.error === false){
                    var img = $("#rep-img-" + id);
                    img.fadeOut(function(){
                        img.remove();
                    });
                } else {
                    lobiAlert('error', 'Ocurrió un error al eliminar la imagen');
                }
            }
        });
        
    }
</script>