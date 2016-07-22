<?php 
$formulario = new CBForm(['id' => 'form-equipos']);
$formulario->abrir();
?>
<?php echo $formulario->campoNumber($modelo, 'cupo_maximo', ['label' => true, 'group' => true, 'autofocus' => true]) ?>
<?php echo $formulario->campoNumber($modelo, 'cupo_minimo', ['label' => true, 'group' => true]) ?>
<?php echo $formulario->campoTexto($modelo, 'estado', ['label' => true, 'group' => true]) ?>
<?php echo $formulario->campoTexto($modelo, 'posicion', ['label' => true, 'group' => true]) ?>
<?php echo $formulario->campoTexto($modelo, 'entrenador_id', ['label' => true, 'group' => true]) ?>
<?php echo $formulario->campoTexto($modelo, 'deportista_id', ['label' => true, 'group' => true]) ?>

<div class="row">
    <div class="col-sm-offset-6 col-sm-3">
        <?php echo CHtml::link(CBoot::fa('undo').' Cancelar', ['equipo/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
    </div>
    <div class="col-sm-3">
        <?php echo CBoot::boton(CBoot::fa('save') .' '. ($modelo->nuevo? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block']); ?>
    </div>
</div>

<?php $formulario->cerrar(); ?>