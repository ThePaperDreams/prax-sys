<?php 
$formulario = new CBForm(['id' => 'form-categorias']);
$formulario->abrir();
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Datos de la categoría
            </div>
            <div class="panel-body">
                <?php echo $formulario->campoTexto($modelo, 'nombre', ['label' => true, 'group' => true, 'autofocus' => true]) ?>
                <div class="row">
                    <div class="col-sm-3">
                        <?php echo $formulario->campoNumber($modelo, 'edad_minima', ['label' => true, 'group' => true, 'min' => 0, 'class' => 'text-right']) ?>
                    </div>
                    <div class="col-sm-3">
                        <?php echo $formulario->campoNumber($modelo, 'edad_maxima', ['label' => true, 'group' => true, 'min' => 0, 'class' => 'text-right']) ?>
                    </div>
                    <div class="col-sm-3">        
                        <?php echo $formulario->campoNumber($modelo, 'cupo_minimo', ['label' => true, 'group' => true, 'min' => 0, 'class' => 'text-right']) ?>
                    </div>
                    <div class="col-sm-3">        
                        <?php echo $formulario->campoNumber($modelo, 'cupo_maximo', ['label' => true, 'group' => true, 'min' => 0, 'class' => 'text-right']) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <?php echo $formulario->inputAddon($modelo, 'tarifa', 'number', ['label' => true, 'group' => true, 'min' => 0, 'class' => 'text-right'], ['pre' => '$', 'pos' => '.00']) ?>
                    </div>
                    <div class="col-sm-7">
                        <?php echo $formulario->lista($modelo, 'entrenador_id', $entrenadores, ['label' => true, 'group' => true, 'defecto' => 'Seleccione un entrenador']) ?>
                    </div>
                </div>
                <?php echo $formulario->areaTexto($modelo, 'descripcion', ['label' => true, 'group' => true, 'rows' => 8]) ?>
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-sm-offset-4 col-sm-4">
                        <?php echo CHtml::link(CBoot::fa('undo').' Cancelar', ['categoria/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
                    </div>
                    <div class="col-sm-4">
                        <?php echo CBoot::boton(CBoot::fa('save') .' '. ($modelo->nuevo? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block']); ?>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>


<?php $formulario->cerrar(); ?>