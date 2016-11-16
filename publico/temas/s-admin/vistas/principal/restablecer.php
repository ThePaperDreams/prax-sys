<div class="p-15">    
</div>
<div class="col-sm-7">       
    <?php $this->tituloPagina = "Restablecer contraseña"; ?>
    <?php 
    $form = new CBForm(['id' => 'login', 'opcionesHtml' => ['id' => 'drawer', 'class' => 'tile drawer animated']]);
    $form->abrir(); 
    ?>
    <div class="col-sm-4">
        <img id="logo" src="<?= Sis::UrlRecursos() ?>pics/logo.png">
    </div>
    <div class=" col-sm-8">
        <h2 class="m-t-0 m-b-15">Restablecer contraseña</h2>
        <?= CBoot::passwordField('', ['id' => 'clave', 'placeholder' => 'Ingrese la nueva contraseña', 'class' => 'login-control', 'name' => 'recuperar-pwd', 'id' => 'pwd1', 'autofocus' => true, 'maxlength' => 40]) ?>
        <div class="p-5"></div>
        <?= CBoot::passwordField('', ['id' => 'clave', 'placeholder' => 'Confirme la contraseña', 'class' => 'login-control', 'id' => 'pwd2', 'maxlength' => 40]) ?>
        <div class="p-5"></div>
        <?=  CBoot::boton('Restablecer', 'success btn-block', ['class' => 'btn btn-sm m-r-5']); ?>
        <div class="p-5"></div>
        <a class="btn btn-primary btn-block" href="<?= Sis::CrearUrl(['principal/entrar']) ?>">Iniciar sesión</a>
        <div class="p-5"></div>
    </div>
    <?php $form->cerrar() ?>        
</div>
<script>
    $(function(){
        $("#login").submit(function(){
            var pwd1 = $("#pwd1");
            var pwd2 = $("#pwd2");
            var send = false;
            if($.trim(pwd1.val()) === ""){
                lobiAlert("error", "Por favor ingrese una contraseña");
                pwd1.focus();
            } else if(pwd1.val().length < 6){
                lobiAlert("error", "La contraseña debe tener un mínimo de 6 cáracteres");
                pwd1.focus();
            } else if($.trim(pwd2.val()) === ""){
                lobiAlert("error", "Por favor confirme la contraseña");
                pwd2.focus();
            } else if(pwd1.val() !== pwd2.val()){
                lobiAlert("error", "Las contraseñas no coinciden");
                pwd2.focus().select();
            } else {
                send = true;
            }
            return send;
        });
        
        
        $("#pwd1, #pwd2").css({
            position: "relative",
            right: "180%",
        });
        $("#logo").hide();
        
        var delay = 500;
        setTimeout(function(){
            $("#pwd1").animate({
                position: "relative",
                right: "0%",
            }, delay, function(){
                $("#pwd2").animate({
                    position: "relative",
                    right: "0%",
                }, delay, function(){
                    $("#logo").fadeIn(delay + 200);
                });
            });            
            
        }, 1000);
    });
</script>
