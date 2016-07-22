<?php

$formulario = new CBForm(['id' => 'form-publicaciones']);
$formulario->abrir();
?>

<?php echo $formulario->inputAddon($modelo, 'titulo', 'texto', ['label' => true, 'group' => true, 'autofocus' => true], 'font') ?>
<?php echo $formulario->areaTexto($modelo, 'contenido', ['label' => true, 'group' => true]) ?>
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

<script>
  $(function() {
    $( "#datepicker" ).datepicker({
        dateFormat: 'yy-mm-dd',
    });
    $( "#datepicker2" ).datepicker({
        dateFormat: 'yy-mm-dd',
    });
    $('#timepicker').timepicker({
        showLeadingZero: false,
        showPeriodLabels: false,
    });
 });
  
  
 </script>

<?php $formulario->cerrar(); ?>