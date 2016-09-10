
<?php
$form = new CBForm(['id' => 'frmRestablecer']);
$form->abrir();     
?>    
    <div class="col-sm-8">
        <div class="tile p-15">
            <div class="row">
                <div class="col-sm-4"> 
                <img id="logo" src="<?= Sis::UrlRecursos() ?>pics/logo.png">
                </div>
                <div class="col-sm-7">
                    <br><div>
                    <h3 id="clave">Restaurar Contraseña </h3>
                    </div>
                    <div class="p-15"></div>
                    <div class="form-group">
                        <label id="label" for="email"> Escribe el email asociado a tu cuenta para recuperar tu contraseña </label>
                        <input type="email" id="email" class="form-control" name="email" required>
                    </div>
                    <div class="p-5"></div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Recuperar contraseña" >
                    </div>        
                </div>
            </div>
        </div>
    </div>    
<?php $form->cerrar() ?> 
 
<div id="mensaje"></div>

<script>
  $(document).ready(function(){
       $("#email,#clave").css({
            position: "relative",
            right: "180%",
        });
        //$("#logo").hide();
        
        var delay = 500;
        setTimeout(function(){
            $("#email").animate({
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
    $("#frmRestablecer").submit(function(event){
        if(validarClave()){
            event.preventDefault();
              $.ajax({
                  url: '<?= Sis::crearUrl(['principal/recuperarClave']) ?>',
                  type: 'post',
                  dataType: 'json',
                  data: $("#frmRestablecer").serializeArray()
              }).done(function (respuesta) {
                  $("#mensaje").html(respuesta.mensaje);
                  $("#email").val('');
              });
          });
          }else{
            return false;
          }
      });
      

function validarClave() {
        var claveRegex = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;
        var clave = $("#usuario-clave");
        var clave2 = $("#confirmar-clave").val(); 
        if (clave.val() !== "" && clave.val() === clave2) {
            if(claveRegex.test(clave.val())){
                return true;
            }else{
                mostrarAlert("error", "La Clave debe contener: 6 o más caracteres, mínimo un número, una letra minúscula y una letra mayúscula.");
                clave.focus();
                return false;
            }
        }else{
            mostrarAlert("error", "Las Constraseñas no coinciden");
            clave.focus();
            return false;
        }        
    }
</script>