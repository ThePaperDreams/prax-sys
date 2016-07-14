<?php $this->tituloPagina = ""; ?>
<div class="col-sm-4 col-sm-offset-4">
    <?php 
    $form = new CBForm(['id' => 'login']);
    $form->abrir(); 
    ?>
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            Iniciar sesión
        </div>
        <div class="panel-body">            
            <?= CBoot::text('', ['group' => true, 'placeholder' => 'Ingrese su nombre de usuario', 'autofocus' => true, 'name' => 'login-usr']) ?>
            <?= CBoot::passwordField('', ['group' => true, 'placeholder' => 'Ingrese su contraseña', 'autofocus' => true, 'name' => 'login-pwd']) ?>            
        </div>
        <div class="panel-footer">
            <?=  CBoot::boton('Iniciar sesión', 'success', ['class' => 'btn-block']); ?>
        </div>
    </div>
    <?php $form->cerrar() ?>
</div>
