<table style="width: 100%;font-family: arial;border-collapse: collapse;" >
    <tr>
        <td style="padding: 20px 50px 0px 50px;background-color: #525252;color: white;border-radius: 10px 10px 0px 0px;">
            <img src="<?= Sis::UrlBase() ?>recursos/pics/logo_email.png" style="width: 100px;float: left;" width="100px"> 
            <h2 style="line-height: 90px;"><?= Configuracion::get('nombre_club'); ?></h2>
        </td>
    </tr>
    <tr>
        <td style="text-align: justify;padding: 10px 100px;">
            <?= $mensaje ?>
        </td>
    </tr>
    <tr>
        <td style="text-align: center;padding: 10px;background-color: #525252;">
            <p>
                <a style="color: white;" href="<?= Configuracion::get('url_sitio_web') ?>">Contactenos</a>
            </p>
        </td>
    </tr>
</table>