<?php 
$formulario = new CBForm(['id' => 'form-eventos']);
$formulario->abrir();
?>
<div class="tile p-15">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#listar" aria-controls="listar" role="tab" data-toggle="tab">Contenido</a></li>
        <li role="presentation"><a href="#cargar" aria-controls="cargar" role="tab" data-toggle="tab">Evento</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="listar">
            <div class="form-group">
                <?php echo $formulario->campoTexto($modelo, 'titulo', ['label' => true, 'group' => true, 'autofocus' => true]) ?>
                <?php echo $formulario->areaTexto($modelo, 'contenido', ['label' => true, 'group' => true, 'class' => 'summernote']) ?>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="cargar">
            <div class="row" id="tab-imagenes">
                <div class="col-sm-6">
                    <div class="form-group">
                        <?php echo $formulario->campoTexto($modelo, 'fecha_publicacion', ['label' => true, 'group' => true, 'class' => 'campo-fecha']) ?>
                    </div>
                </div>   
                <div class="col-sm-6">
                    <div class="form-group">
                        <?php echo $formulario->campoTexto($modelo, 'fecha_disponibilidad', ['label' => true, 'group' => true, 'class' => 'campo-fecha']) ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Tipos de Eventos</label>
                        <div class="input-group">  
                            <?php echo $formulario->lista($modelo, 'tipo_id', $TipoEvento, ['defecto' => 'Seleccione un tipo']) ?>
                        <div class="input-group-addon"><i class="fa fa-qrcode"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Estado</label>
                        <div class="input-group">
                            <?php echo $formulario->lista($modelo, 'estado_id', $Estado, ['defecto' => 'Seleccione un estado para el evento']) ?>
                            <div class="input-group-addon"><i class="fa fa-list-ul"></i></div>
                        </div>
                    </div>          
                </div>
                <div class="col-sm-6">
                    <div class="form-group">    
                        <?php echo $formulario->campoTexto($modelo, 'lugar', ['label' => true,]) ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group"> 
                        <p id="err-hora" class="text-danger form-requerido" style="display:none">El campo <b>Hora</b> no puede estar vacio</p>
                        <label>Hora</label>
                        <div class="input-icon datetime-pick time-only">
                            <input data-format="hh:mm:ss" type="text" name="Eventos[hora]" class="form-control input-md" id="Eventos_hora" requerido="1"/>
                            <span class="add-on">
                                <i class="sa-side-ui"></i>
                            </span>
                        </div>
                    </div>
                </div>    
            </div>
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
    $('.summernote').summernote({
        height: 300,
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
        var currDate = new Date();
        var date = Date.parse(fecha.val());
        if (date >= currDate) {
            $('#btn-send').removeAttr("disabled");
        } else {
            alert("Por favor seleccione una fecha mayor a la de hoy");
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