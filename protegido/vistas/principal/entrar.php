<?php
$this->migas = [
    'Home' => ['principal/inicio'],
    'Entrar'
];
?>
<fieldset>
    <legend>Iniciar sesión</legend>
    <div class="col-sm-6">
        <?php 
        $form = new CBForm(['id' => 'login']);
        $form->abrir();
        
        echo CBoot::text('', ['group' => true, 'placeholder' => 'Ingrese su nombre de usuario', 'autofocus' => true, 'name' => 'login-usr']);
        echo CBoot::passwordField('', ['group' => true, 'placeholder' => 'Ingrese su contraseña', 'autofocus' => true, 'name' => 'login-pwd']);
        echo CBoot::boton('Iniciar sesión', 'success', ['class' => 'btn-block']);
        $form->cerrar();
        
        ?>
    </div>
</fieldset>