<?php

$formulario = new CBForm(['id' => 'form-publicaciones']);
$formulario->abrir();
?>
<div class="tile p-15">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#listar" aria-controls="listar" role="tab" data-toggle="tab">Contenido</a></li>
        <li role="presentation"><a href="#cargar" aria-controls="cargar" role="tab" data-toggle="tab">Publicación</a></li>
    </ul>
     <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="listar">
            <div class="form-group">
                <?php echo $formulario->inputAddon($modelo, 'titulo', 'texto', ['label' => true, 'group' => true, 'autofocus' => true], 'font') ?>
                <?php echo $formulario->areaTexto($modelo, 'contenido', ['label' => true, 'group' => true, 'class' => 'summernote']) ?>
            </div>
        </div>    
        <div role="tabpanel" class="tab-pane" id="cargar">
            <div class="row" id="tab-imagenes">
                <div class="form-group">
                    <label>Tipos de Publicación</label>
                    <div class="input-group">  
                        <?php echo $formulario->lista($modelo, 'tipo_id', $public, ['defecto' => 'Seleccione un tipo']) ?>
                    <div class="input-group-addon"><i class="fa fa-qrcode"></i></div>
                    </div>
                </div>    
                <?php echo $formulario->inputAddon($modelo, 'consecutivo','texto', ['label' => true, 'group' => true], 'list-ol') ?>
                <?php echo $formulario->inputAddon($modelo, 'fecha_publicacion', 'texto', ['label' => true, 'group' => true, 'id' => 'datepicker'], 'calendar') ?>
                <?php echo $formulario->inputAddon($modelo, 'fecha_disponibilidad','texto', ['label' => true, 'group' => true, 'id' => 'datepicker2'],'calendar-check-o') ?>
                 <div class="form-group">
                    <label>Estado</label>
                    <div class="input-group">

                        <?php echo $formulario->lista($modelo, 'estado_id', $estd, ['defecto' => 'Seleccione un estado para la publicación']) ?>
                        <div class="input-group-addon"><i class="fa fa-list-ul"></i></div>
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
    </div>
</div>    

<script>
  $(function() {
    $( "#datepicker" ).datepicker({
        dateFormat: 'yy-mm-dd',
    });
    $( "#datepicker2" ).datepicker({
        dateFormat: 'yy-mm-dd',
    });    
    
    $(document).ready(function() {
    $('.summernote').summernote();
    $("#datapicker").change(function(){
            validarFecha($(this));
        });
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
</script> 

<?php $formulario->cerrar(); ?>