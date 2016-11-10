<div class="p-15">    
</div>
<div class="col-sm-7">       
    <?php $this->tituloPagina = "Iniciar sesión"; ?>
    <?php 
    $form = new CBForm(['id' => 'login', 'opcionesHtml' => ['id' => 'drawer', 'class' => 'tile drawer animated']]);
    $form->abrir(); 
    ?>
    <div class="col-sm-4">
        <img id="logo" src="<?= Sis::UrlRecursos() ?>pics/logo.png">
    </div>
    <div class=" col-sm-8">
        <h2 class="m-t-0 m-b-15">Iniciar sesión</h2>
        <?= CBoot::text('', ['id' => 'usuario', 'placeholder' => 'Ingrese su nombre de usuario', 'class' => 'login-control m-b-10', 'autofocus' => true, 'name' => 'login-usr']) ?>
        <?= CBoot::passwordField('', ['id' => 'clave', 'placeholder' => 'Ingrese su contraseña', 'class' => 'login-control', 'name' => 'login-pwd']) ?>            
        <div class="p-5"></div>
        <?=  CBoot::boton('Iniciar sesión', 'success btn-block', ['class' => 'btn btn-sm m-r-5']); ?>
        <div class="p-5"></div>
        <p class="text-center">
            <a href="<?= Sis::crearUrl(['principal/recuperarClave'])?>">¿Olvidó su contraseña?</a>
        </p>
    </div>
    <?php $form->cerrar() ?>        
</div>
<script>
    $(function(){
        $("#usuario, #clave").css({
            position: "relative",
            right: "180%",
        });
        $("#logo").hide();

        $("#login").submit(function(){
            var usuario =  $("#usuario");
            var clave = $("#clave");

            if($.trim(usuario.val()) == ""){
                lobiAlert("error", "Por favor ingrese su nombre de usuario o e-mail");
                usuario.focus();
                return false;
            } else if($.trim($("#clave").val()) == ""){
                lobiAlert("error", "Por favor ingrese su contraseña");
                clave.focus();
                return false;
            }
        });
        
        var delay = 500;
        setTimeout(function(){
            $("#usuario").animate({
                position: "relative",
                right: "0%",
            }, delay, function(){
                $("#clave").animate({
                    position: "relative",
                    right: "0%",
                }, delay, function(){
                    $("#logo").fadeIn(delay + 200);
                });
            });            
            
        }, 1000);
    });
</script>
