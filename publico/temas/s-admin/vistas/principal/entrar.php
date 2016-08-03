<div class="p-15">    
</div>
<div class="col-sm-6">   
<!--<div class="box">-->    
    <?php $this->tituloPagina = "Iniciar sesión"; ?>
    <?php 
    $form = new CBForm(['id' => 'login', 'opcionesHtml' => ['id' => 'drawer', 'class' => 'tile drawer animated']]);
    $form->abrir(); 
    ?>
    <h2 class="m-t-0 m-b-15">Login</h2>
    <?= CBoot::text('', ['placeholder' => 'Ingrese su nombre de usuario', 'class' => 'login-control m-b-10', 'autofocus' => true, 'name' => 'login-usr']) ?>
    <?= CBoot::passwordField('', ['placeholder' => 'Ingrese su contraseña', 'class' => 'login-control', 'name' => 'login-pwd']) ?>            
    <div class="p-15"></div>
    <?=  CBoot::boton('Iniciar sesión', 'success', ['class' => 'btn btn-sm m-r-5']); ?>
    <?php $form->cerrar() ?>
</div>
<!--</div>-->