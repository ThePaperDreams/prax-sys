<table style="width: 100%;font-family: arial;border-collapse: collapse;" >
    <tr>
        <td style="padding: 20px 50px 0px 50px;background-color: #525252;color: white;border-radius: 10px 10px 0px 0px;">
            <img src="<?= Sis::UrlBase() ?>recursos/pics/logo_email.png" style="width: 100px;float: left;" width="100px"> 
            <h2 style="line-height: 90px;">Recuperación de contraseña</h2>
        </td>
    </tr>
    <tr>
        <td style="text-align: justify;padding: 10px 100px;">
            <p>Has solicitado modificar tu contraseña, haz clic <a href="<?= Sis::CrearUrl(['principal/restablecerClave', 't' => $url]) ?>">aquí</a> para 
            ingresar una nueva contraseña </p>
            <p><b>Nota:</b> Una vez hayas finalizado el proceso este enlace no será valido</p>
            <p>Si no haz inciado un proceso de recuperación de contraseña da clic <a href="<?= Sis::CrearUrl(['principal/cancelarRecuperacion', 't' => $url]) ?>">aquí</a> para cancelar</p>
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