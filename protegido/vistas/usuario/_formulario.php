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
            <?php echo $formulario->campoTexto($modelo, 'nombres', ['label' => true, 'group' => true]) ?>        
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?php echo $formulario->campoTexto($modelo, 'apellidos', ['label' => true, 'group' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?php echo $formulario->campoNumber($modelo, 'telefono', ['label' => true, 'group' => true, 'min' => '0']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?php echo $formulario->campoTexto($modelo, 'nombre_usuario', ['label' => true, 'group' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?php echo $formulario->campoTexto($modelo, 'email', ['label' => true, 'group' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?php echo $formulario->campoPassword($modelo, 'clave', ['label' => true, 'group' => true, 'value' => '']) ?>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="confirmar-clave">Confirmar Clave <span class="text-danger">*</span></label>
                <p class="text-danger form-requerido" style="display:none" id="err-clave">El campo <b>Confirmar Clave</b> no puede estar vacio</p>
                <?= CBoot::passwordField('', ['requerido' => '1', 'class' => 'form-group', 'id' => 'confirmar-clave', 'value' => '']) ?>
            </div>
        </div>
    </div>

    <?php echo $formulario->campoArchivo($modelo, 'foto', ['label' => true, 'group' => true]) ?>

    <div class="row">
        <div class="col-sm-offset-6 col-sm-3">
            <?php echo CHtml::link(CBoot::fa('undo') . ' Cancelar', ['usuario/inicio'], ['class' => 'btn btn-primary btn-block']); ?>
        </div>
        <div class="col-sm-3">
            <?php echo CBoot::boton(CBoot::fa('save') . ' ' . ($modelo->nuevo ? 'Guardar' : 'Actualizar'), 'success', ['class' => 'btn-block']); ?>
        </div>
    </div>
</div>

<?php $formulario->cerrar(); ?>

<script>
    $(function () {
        $("#Usuarios_foto").fileinput({
            showPreview: false,
            showRemove: false,
            showUpload: false,
            browseLabel: "Seleccionar archivo",
        });
        $("#form-usuarios").submit(function () {
            if (validarClave()) {
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
                email: $.trim(email),
            },
            success: function (respuesta) {
                if (respuesta.error === true) {
                    mostrarAlert("error", "Ya existe ese Usuario o Email");
                    $("#Usuarios_nombre_usuario").focus().select();
                } else {                    
                    document.getElementById("form-usuarios").submit();
                }
            }
        });
    }
        $("#Usuarios_clave").val('');
        $("#confirmar-clave").val('');
    });

    function validarClave() {
        var clave = $("#Usuarios_clave").val();
        var clave2 = $("#confirmar-clave").val();        
        if (clave === clave2 && clave !== "" && clave2 !== "") {
            return true;
        } else {
            mostrarAlert("error", "Las Constraseñas no son iguales");
            return false;
        }
    }   

    function mostrarAlert(tipo, msg) {
        Lobibox.notify(tipo, {
            size: 'mini',
            showClass: 'bounceInRight',
            hideClass: 'bounceOutRight',
            msg: msg,
            delay: 8000,
            soundPath: '<?= Sis::UrlRecursos() ?>librerias/lobibox/sounds/',
        });
    }
</script>