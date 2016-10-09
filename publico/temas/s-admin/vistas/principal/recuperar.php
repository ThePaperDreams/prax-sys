<div class="col-sm-offset-2 col-sm-8">
    <?php $this->tituloPagina = "Recuperar contraseña"; ?>
    <?php 
    $form = new CBForm(['id' => 'login', 'opcionesHtml' => ['id' => 'drawer', 'class' => 'tile drawer animated']]);
    $form->abrir(); 
    ?>
    <div class=" col-sm-offset-2 col-sm-8">
        <h2 class="m-t-0 m-b-15">Recuperar contraseña</h2>
        <div class="alert alert-info">
            Ingrese la dirección de correo electrónico con que se encuentra registrado.
        </div>
        <?= CBoot::text($email, ['id' => 'usuario', 'placeholder' => 'Ingrese su dirección de correo electrónico', 'class' => 'login-control m-b-10', 'autofocus' => true, 'name' => 'email']) ?>
        <div class="p-5"></div>
        <?=  CBoot::boton('Enviar correo ' . CBoot::fa('send'), 'success btn-block', ['class' => 'btn btn-sm m-r-5']); ?>
        <div class="p-5"></div>
        <p>
            <a class="btn btn-block btn-primary" href="<?= Sis::CrearUrl(['principal/inicio']) ?>">
                Iniciar sesión
            </a>
        </p>
    </div>    
    <?php $form->cerrar() ?>        
</div>
<div class="p-15"></div>