<?php 
$formulario = new CBForm(['id' => 'form-torneos', 'opcionesHtml' =>['enctype' => 'multipart/form-data']]);
$formulario->abrir();
?>
<div class="tile p-15">
<div class="row">
    <div class="col-sm-6">    
        <?php echo $formulario->campoTexto($modelo, 'nombre', ['label' => true, 'group' => true]) ?>
    </div>
    <div class="col-sm-6">
        <?php echo $formulario->campoNumber($modelo, 'cupo_maximo', ['label' => true, 'group' => true, 'autofocus' => true , 'min'=> 1, 'max'=> 3]) ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">    
        <?php echo $formulario->campoNumber($modelo, 'cupo_minimo', ['label' => true, 'group' => true, 'min'=> 1, 'max'=> 3]) ?>
    </div>
    <div class="col-sm-6">
        <?php echo $formulario->campoNumber($modelo, 'edad_maxima', ['label' => true, 'group' => true, 'min'=> 5, 'max'=> 16]) ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php echo $formulario->inputAddon($modelo, 'fecha_inicio', 'texto', ['label' => true, 'group' => true, 'id' => 'datepicker'], 'calendar') ?>
    </div>
    <div class="col-sm-6">
        <?php echo $formulario->inputAddon($modelo, 'fecha_fin','texto', ['label' => true, 'group' => true, 'id' => 'datepicker2'],'calendar-check-o') ?> 
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php echo $formulario->campoArchivo($modelo, 'tabla_posiciones', ['label' => true, 'group' => true]) ?>
    </div>
    <div class="col-sm-6">
        <?php echo $formulario->lista($modelo, 'equipo_id', $mEquipo, ['label'=> true,'defecto' => 'Seleccione el equipo a participar en el torneo']) ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <?php echo $formulario->areaTexto($modelo, 'observaciones', ['label' => true, 'group' => true]) ?> 
    </div>
</div>    
    <div class="row">
        <div class="col-sm-offset-6 col-sm-3">
            <?php echo CHtml::link(CBoot::fa('undo').' Cancelar', ['torneo/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
        </div>
        <div class="col-sm-3">
            <?php echo CBoot::boton(CBoot::fa('save') .' '. ($modelo->nuevo? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block']); ?>
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
 });
  
  
 </script>

<?php $formulario->cerrar(); ?>