<?php 
$formulario = new CBForm(['id' => 'form-usuarios']);
$formulario->abrir();
?>


<div class="row">
    <div class="col-sm-6">
        <?php echo $formulario->lista($modelo, 'rol_id', $roles, ['label' => true, 'group' => true, 'autofocus' => true, 'defecto'=>'Seleccione un Rol']) ?>
    </div>
    <div class="col-sm-6">
        <?php echo $formulario->campoTexto($modelo, 'nombres', ['label' => true, 'group' => true]) ?>        
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <?php echo $formulario->campoTexto($modelo, 'apellidos', ['label' => true, 'group' => true]) ?>
    </div>
    <div class="col-sm-6">
        <?php echo $formulario->campoNumber($modelo, 'telefono', ['label' => true, 'group' => true, 'min'=>'0']) ?>
    </div>
</div>

<?php echo $formulario->campoTexto($modelo, 'email', ['label' => true, 'group' => true]) ?>

<div class="row">
    <div class="col-sm-6">
        <?php echo $formulario->campoTexto($modelo, 'nombre_usuario', ['label' => true, 'group' => true]) ?>
    </div>
    <div class="col-sm-6">
        <?php echo $formulario->campoPassword($modelo, 'clave', ['label' => true, 'group' => true]) ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-offset-6 col-sm-3">
        <?php echo CHtml::link(CBoot::fa('undo').' Cancelar', ['usuario/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
    </div>
    <div class="col-sm-3">
        <?php echo CBoot::boton(CBoot::fa('save') .' '. ($modelo->nuevo? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block']); ?>
    </div>
</div>

<?php $formulario->cerrar(); ?>