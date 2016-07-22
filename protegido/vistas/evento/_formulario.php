<?php 
$formulario = new CBForm(['id' => 'form-eventos']);
$formulario->abrir();
?>
<?php echo $formulario->campoTexto($modelo, 'titulo', ['label' => true, 'group' => true, 'autofocus' => true]) ?>
<?php echo $formulario->campoTexto($modelo, 'contenido', ['label' => true, 'group' => true]) ?>
<?php echo $formulario->campoTexto($modelo, 'fecha_publicacion', ['label' => true, 'group' => true]) ?>
<?php echo $formulario->campoTexto($modelo, 'fecha_disponibilidad', ['label' => true, 'group' => true]) ?>
<div class="form-group">
    <label>Tipos de Eventos</label>
    <div class="input-group">  
        <?php echo $formulario->lista($modelo, 'tipo_id', $TipoEvento, ['defecto' => 'Seleccione un tipo']) ?>
    <div class="input-group-addon"><i class="fa fa-qrcode"></i></div>
    </div>
</div>
<?php echo $formulario->campoTexto($modelo, 'lugar', ['label' => true, 'group' => true]) ?>
<?php echo $formulario->campoTexto($modelo, 'hora', ['label' => true, 'group' => true]) ?>
 <div class="form-group">
    <label>Estado</label>
    <div class="input-group">
        
        <?php echo $formulario->lista($modelo, 'estado_id', $Estado, ['defecto' => 'Seleccione un estado para el evento']) ?>
        <div class="input-group-addon"><i class="fa fa-list-ul"></i></div>
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

<?php $formulario->cerrar(); ?>