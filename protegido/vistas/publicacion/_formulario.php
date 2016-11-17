<?php
Sis::Recursos()->RecursoJS(['url' => Sis::Recursos()->getUrlRecursos().'librerias/tinyMce/tinymce.js']);
Sis::Recursos()->RecursoJS(['url' => Sis::apl()->tema->getUrlBase() . '/js/pirobox.min.js']);

Sis::Recursos()->recursoCss(['url' => Sis::urlRecursos() . 'librerias/boot-file-input/css/fileinput.min.css']);
Sis::Recursos()->recursoJs(['url' => Sis::urlRecursos() . 'librerias/boot-file-input/js/fileinput.min.js']);

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
                        <?php echo $formulario->inputAddon($modelo, 'fecha_disponibilidad','texto', ['readonly' => true, 'label' => true, 'group' => true, 'class' => 'campo-fecha', 'id'=>'calendar' ],['pos' => CBoot::fa('calendar-check-o')]) ?>   
                    </div>    
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">Resumen <span id="total-chars">0</span>/<span id="max-chars">150</span> </label>
                    <?php echo $formulario->areaTexto($modelo, 'resumen', [ 'maxlengh' => 150]) ?>
                </div>
            </div>
            <div class="col-sm-6">
                <?php echo $formulario->inputAddon($modelo, 'titulo', 'texto', ['maxlengh' => 100, 'label' => true, 'group' => true, 'autofocus' => true], 'font') ?>
            </div>
            <div class="col-sm-6">
                <?php echo $formulario->inputAddon($modelo, 'img_previsualizacion', 'texto', ['maxlengh' => 300, 'label' => true, 'group' => true, 'autofocus' => true], ['pos' => CBoot::fa('picture-o')]) ?>
            </div>
            <div class="col-sm-12">
                <?php echo $formulario->areaTexto($modelo, 'contenido', ['label' => true, 'group' => true, 'class' => 'summernote', 'rows' => 15]) ?>
            </div>
        </div>    
        <div role="tabpanel" class="tab-pane" id="cargar">
            <div class="row" id="tab-imagenes">
                
                <?= $this->vistaP('_imagenes', ['imagenes' => $imagenes]) ?>
                
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

<script>
    
    $(document).ready(function() {
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
            link_assume_external_targets: true
        });
        
    $("#calendar").change(function(){
            validarFecha($(this));
        });
    });
 
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
                    mostrarAlert("error", "Ya existe ese nombre");
                } else {
                    document.getElementById("form-publicaciones").submit();
                }
            }
        });
    }

    function mostrarAlert(tipo, msg) {
        Lobibox.notify(tipo, {
            size: 'mini',
            showClass: 'bounceInRight',
            hideClass: 'bounceOutRight',
            msg: msg,
            delay: 8000,
            soundPath: '<?= Sis::UrlRecursos() ?>librerias/lobibox/sounds/',
        });
    }
    
</script>

<?php $formulario->cerrar(); ?>