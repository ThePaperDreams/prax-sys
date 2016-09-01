<?php
Sis::Recursos()->recursoCss(['url' => Sis::urlRecursos() . 'librerias/boot-file-input/css/fileinput.min.css']);
Sis::Recursos()->recursoJs(['url' => Sis::urlRecursos() . 'librerias/boot-file-input/js/fileinput.min.js']);
$formulario = new CBForm(['id' => 'form-usuarios', 'opcionesHtml' => ['enctype' => 'multipart/form-data']]);
$formulario->abrir();
?>

<div class="tile p-15">
    <p>Los campos con <span class="text-danger">*</span>  son requeridos</p>
    <div class="row">
        <div class="col-sm-6">
            <?php echo $formulario->lista($modelo, 'rol_id', $roles, ['label' => true, 'group' => true, 'autofocus' => true, 'defecto' => 'Seleccione un Rol']) ?>
        </div>
        <div class="col-sm-6">
            <?php echo $formulario->campoTexto($modelo, 'nombres', ['label' => true, 'group' => true, 'maxlength' => '40']) ?>        
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?php echo $formulario->campoTexto($modelo, 'apellidos', ['label' => true, 'group' => true, 'maxlength' => '40']) ?>
        </div>
        <div class="col-sm-6">
            <?php echo $formulario->campoNumber($modelo, 'telefono', ['label' => true, 'group' => true, 'min' => '0', 'maxlength' => '30']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?php echo $formulario->campoTexto($modelo, 'nombre_usuario', ['label' => true, 'group' => true, 'maxlength' => '30']) ?>
        </div>
        <div class="col-sm-6">
            <?php echo $formulario->campoTexto($modelo, 'email', ['label' => true, 'group' => true, 'maxlength' => '80']) ?>
        </div>
    </div>

    <div class="row">
    <?php if (!$modelo->nuevo): ?> <!-- Actualizacion -->
    <input hidden="" value="0" id="change-pass" name="cambio-clave">
        <div class="col-sm-6">
            <?php echo CBoot::botonP('Cambiar contraseña', ['type' => 'button', 'label' => true, 'group' => true, 'id' => 'btn-cambiar', 'onClick' => 'activarCambioPass()', 'class' => 'btn-block']) ?>
        </div>        
    <?php endif; ?>
    <input hidden="" value="0" id="change-foto" name="cambio-foto">
    <?php if (!is_null($modelo->foto)): ?>
    <div class="col-sm-6">
        <?php echo CBoot::botonP('Cambiar foto', ['type' => 'button', 'label' => true, 'group' => true, 'id' => 'btn-cambiarFoto', 'onClick' => 'activarCambioFoto()', 'class' => 'btn-block', 'data' => '0']) ?>
    </div>    
    <?php endif; ?>
    </div>
    <div class="row" <?php if (!$modelo->nuevo): ?>style="display:none" id="passwords"<?php endif; ?>>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="usuario-clave">Clave <span class="text-danger">*</span></label>
                <p class="text-danger form-requerido" style="display:none" id="err-clave">El campo <b>Clave</b> no puede estar vacio</p>
                <?= CBoot::passwordField('', ['requerido' => '1', 'class' => 'form-group', 'id' => 'usuario-clave', 'name' => 'Usuarios[uclave]']) ?>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="confirmar-clave">Confirmar Clave <span class="text-danger">*</span></label>
                <p class="text-danger form-requerido" style="display:none" id="err-clave">El campo <b>Confirmar Clave</b> no puede estar vacio</p>
                <?= CBoot::passwordField('', ['requerido' => '1', 'class' => 'form-group', 'id' => 'confirmar-clave']) ?>
            </div>
        </div>
    </div>
        
    <div class="row" <?php if (!is_null($modelo->foto)): ?>style="display:none" id="fotos"<?php endif; ?>>
        <div class="col-sm-12">
            <?php echo $formulario->campoArchivo($modelo, 'foto', ['label' => true, 'group' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-offset-6 col-sm-3">
            <?php echo CHtml::link(CBoot::fa('undo') . ' Cancelar', ['usuario/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
        </div>
        <div class="col-sm-3">
            <?php echo CBoot::boton(CBoot::fa('save') . ' ' . ($modelo->nuevo ? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block']); ?>
        </div>
    </div>
<?php $formulario->cerrar(); ?>
</div>
<script>
    $(function () {
        $("#Usuarios_foto").fileinput({
            showPreview: false,
            showRemove: false,
            showUpload: false,
            browseLabel: "Seleccionar archivo",
            maxFileSize: 5000,
            allowedFileExtensions: ['jpg', 'gif', 'png', 'jpeg']         
        });
        $("#form-usuarios").submit(function(){
            var camcla = $("#change-pass").val();            
            validarSubidaFoto();
            // === undefined por si es un registro y no una actualizacion
            if (camcla === "1" || camcla === undefined) {
                if (validarClave()) {
                    validarUsuarioEmail();
                }
            }else{
                validarUsuarioEmail();
            }
            return false;
        });
        function validarUsuarioEmail() {
        var email = $("#Usuarios_email").val();
        var usuario = $("#Usuarios_nombre_usuario").val();
        if (email === "" || usuario === "") {
            return false;
        }
        $.ajax({
            type: 'POST',
            url: '<?php echo $url ?>',
            data: {
                validarUsuarioEmail: true,
                usuario: $.trim(usuario),
                email: $.trim(email)
            },
            success: function (respuesta) {
                if (respuesta.error === true) {
                    mostrarAlert("error", "Ya existe ese Usuario o Email");
                } else {                    
                    document.getElementById("form-usuarios").submit();
                }
            }
        });
    }
    });

    function validarClave() {
        var clave = $("#usuario-clave").val();
        var clave2 = $("#confirmar-clave").val();        
        if (clave === clave2 && clave !== "" && clave2 !== "") {
            return true;
        } else {
            mostrarAlert("error", "Las Constraseñas no son iguales");
            return false;
        }
    }   
    
    function cambiarInformacion(display, html, val){
        $("#passwords").attr("style", "display:" + display);
        $("#btn-cambiar").html(html);
        $("#change-pass").val(val);
        
    }    
    
    function activarCambioPass(){
        var chapas = $("#change-pass");
        if (chapas.val() === "0") {
            cambiarInformacion("true", "Cancelar", "1");
        }else{
            cambiarInformacion("none", "Cambiar contraseña", "0");
        }                
    }
    
    function validarSubidaFoto(){
        if ($("#Usuarios_foto").val() !== "") {
            $("#change-foto").val("1");
          //  alert('d');
        }
        //console.log($("#Usuarios_foto").val());
    }
    
    function activarCambioFoto(){
        var invisible = $("#btn-cambiarFoto").attr("data");
        if (invisible === "0") {
            $("#fotos").attr("style", "display:true");
            $("#btn-cambiarFoto").html("Cancelar");
            $("#btn-cambiarFoto").attr("data", "1");
        }else{
            $("#fotos").attr("style", "display:none");
            $("#btn-cambiarFoto").html("Cambiar foto");
            $("#btn-cambiarFoto").attr("data", "0");
            $("#Usuarios_foto").val("");            
            $(".file-caption-name").html("");            
            //console.log($("#Usuarios_foto").val());
        }
    }    

    function mostrarAlert(tipo, msg) {
        Lobibox.notify(tipo, {
            size: 'mini',
            showClass: 'bounceInRight',
            hideClass: 'bounceOutRight',
            msg: msg,
            delay: 8000,
            soundPath: '<?= Sis::UrlRecursos() ?>librerias/lobibox/sounds/'
        });
    }
</script>