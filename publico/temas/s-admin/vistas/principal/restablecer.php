<form action="<?= Sis::crearUrl(['principal/cambiarContrasena'])?>" method="post">
    <div class="panel panel-default">
        <div class="panel-heading"> Restaurar contraseña </div>
        <div class="panel-body">
            <p></p>
            <div class="form-group">
                <label for="password"> Nueva contraseña </label>
                <input type="password" class="form-control" name="password1" required>
            </div>
            <div class="form-group">
                <label for="password2"> Confirmar contraseña </label>
                <input type="password" class="form-control" name="password2" required>
            </div>
            <input type="hidden" name="token" value="<?php echo $token ?>">
            <input type="hidden" name="idusuario" value="<?php echo $idusuario ?>">
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Recuperar contraseña" >
            </div>
        </div>
    </div>
</form>