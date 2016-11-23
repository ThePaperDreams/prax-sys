<?php 
Sis::Recursos()->RecursoJS(['url' => Sis::Recursos()->getUrlRecursos().'librerias/tinyMce/tinymce.js']);
Sis::Recursos()->RecursoJS(['url' => Sis::apl()->tema->getUrlBase() . '/js/pirobox.min.js']);

Sis::Recursos()->recursoCss(['url' => Sis::urlRecursos() . 'librerias/boot-file-input/css/fileinput.min.css']);
Sis::Recursos()->recursoJs(['url' => Sis::urlRecursos() . 'librerias/boot-file-input/js/fileinput.min.js']);

$formulario = new CBForm(['id' => 'form-eventos']);
$formulario->abrir();
?>
<div class="tile p-15">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#listar" aria-controls="listar" role="tab" data-toggle="tab">Contenido</a></li>
        <li role="presentation"><a href="#cargar" aria-controls="cargar" role="tab" data-toggle="tab">Galerías</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="listar">
            <div class="col-sm-4">
                <?php echo $formulario->lista($modelo, 'tipo_id', $TipoEvento, ['defecto' => 'Seleccione un tipo', 'label' => true]) ?>
            </div>   
<!--             <div class="col-sm-4">
                <?php echo $formulario->campoTexto($modelo, 'fecha_disponibilidad', ['label' => true, 'data-val-maxmin' => true, 'group' => true, 'class' => 'campo-fecha', 'readonly' => true]) ?>
            </div>   -->
            <div class="col-sm-4">
                <?php echo $formulario->campoTexto($modelo, 'fecha', ['data-val-maxmin' => true, 'label' => true, 'group' => true, 'class' => 'campo-fecha', 'readonly' => true]) ?>
            </div>  
            <div class="col-sm-4">
            <?php if ($modelo->nuevo == false): ?>
                <?php echo $formulario->lista($modelo, 'estado', $Estado, ['group' => true, 'label' => true]) ?>
            <?php else: ?>
                <?php echo $formulario->lista($modelo, 'estado', $Estado, ['group' => true, 'label' => true, 'disabled' => true]) ?>
            <?php endif ?>
            </div>
            <div class="col-sm-8">
                <?php echo $formulario->campoTexto($modelo, 'lugar', ['label' => true, 'group' => true, 'maxlength' => '200']) ?>
            </div>
            <div class="col-sm-4">
                <p id="err-hora" class="text-danger form-requerido" style="display:none">El campo <b>Hora</b> no puede estar vacio</p>
                <label>Hora</label>
                <div class="input-group input-icon datetime-pick time-only">
                    <?php echo $formulario->inputAddon($modelo, 'hora', 'time', ['data-format' => 'hh:mm', 'class' => 'input-md']) ?>
                    <span class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                    </span>
                </div>
            </div>
            
            <div class="col-sm-12">
                <div class="form-group">
                    <?php echo $formulario->campoTexto($modelo, 'titulo', ['label' => true, 'group' => true, 'maxlength' => 100]) ?>
                    <?php echo $formulario->areaTexto($modelo, 'contenido', ['label' => true, 'group' => true, 'class' => 'summernote', 'rows' => 12]) ?>
                </div>                
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="cargar">
            <!--<div class="row" id="tab-imagenes">-->
                <?= $this->vistaP('_galerias', ['imagenes' => $imagenes]) ?>
            <!--</div>-->
        </div>
        <div class="row">
            <div class="col-sm-offset-6 col-sm-3">
                <?php echo CHtml::link(CBoot::fa('undo').' Cancelar', ['evento/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
            </div>
            <div class="col-sm-3">
                <?php echo CBoot::boton(CBoot::fa('save') .' '. ($modelo->nuevo? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block']); ?>
            </div>
        </div>
    </div>    
</div>

<?php $formulario->cerrar(); ?>

<script>
$(document).ready(function() {
//    $('.summernote').summernote({
//        height: 300,
//    });
    tinymce.init({
        selector: '#Eventos_contenido',
        language : 'es',
        plugins: "code,image,pagebreak,advlist,fullscreen,imagetools,link,media,paste,textcolor,wordcount,example,",
        image_advtab: true,
        link_assume_external_targets: true
    });
    
    $(".campo-fecha").change(function(){
            validarFecha($(this));
        });
        
    $("#form-eventos").submit(function(){
        validarNombre();
        return false;
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
    
    function validarNombre() {
        var nombre = $("#Eventos_titulo").val();
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
                console.log(respuesta);
                if (respuesta.error == true) {
                    mostrarAlert("error", "Ya existe ese nombre");
                } else {
                    document.getElementById("form-eventos").submit();
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