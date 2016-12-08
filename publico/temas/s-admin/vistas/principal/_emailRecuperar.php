<table style="width: 100%;font-family: arial;border-collapse: collapse;" >
    <tr>
        <td style="padding: 20px 50px 0px 50px;background-color: #525252;color: white;border-radius: 10px 10px 0px 0px;">
            <img src="<?= Sis::UrlBase() ?>recursos/pics/logo_email.png" style="width: 100px;float: left;" width="100px"> 
            <h2 style="line-height: 90px;">Recuperación de contraseña</h2>
        </td>
    </tr>
    <tr>
        <td style="text-align: justify;padding: 10px 100px;">
            <h4>Señor: <?= $usuario->nombreCompleto ?>.</h4>
            <p>Se ha solicitado recuperar contraseña, para ingresar una nueva contraseña haga clic <a href="<?= Sis::CrearUrl(['principal/restablecerClave', 't' => $url]) ?>">aquí.</a> </p>
            <br>
            <p><b>Nota:</b> Una vez finalizado el proceso de recuperación de contraseña el enlace de restauración en este correo no será válido.  </p>
            <p>Si usted no ha iniciado un proceso de recuperación de contraseña, haga clic <a href="<?= Sis::CrearUrl(['principal/cancelarRecuperacion', 't' => $url]) ?>">aquí</a> para cancelar.</p>
        </td>
    </tr>
    <tr>
        <td style="text-align: center;padding: 10px;background-color: #525252;">
            <p>
                <a style="color: white;" href="http://site.jakolab.com/">Contactenos</a>
            </p>
        </td>
    </tr>
</table>