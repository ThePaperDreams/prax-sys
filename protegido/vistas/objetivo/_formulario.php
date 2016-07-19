<?php 
$formulario = new CBForm(['id' => 'form-objetivos']);
$formulario->abrir();
?>
<div class="panel panel-default">
    <div class="panel-heading">
        Datos del objetivo
    </div>
    <div class="panel-body">
        <?php echo $formulario->campoTexto($modelo, 'titulo', ['label' => true, 'group' => true, 'autofocus' => true]) ?>
        <?php echo $formulario->areaTexto($modelo, 'descripcion', ['label' => true, 'group' => true]) ?>
    </div>
    <div class="panel-footer">
        <div class="row">
            <div class="col-sm-offset-4 col-sm-4">
              <?php echo CHtml::link(CBoot::fa('undo').' Cancelar', ['objetivo/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
            </div>
            <div class="col-sm-4">
              <?php echo CBoot::boton(CBoot::fa('save') .' '. ($modelo->nuevo? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block']); ?>
            </div>
        </div>  
    </div>
</div>

<?php $formulario->cerrar(); ?>