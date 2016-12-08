<?php
# Se importan las librerias base js y css
Sis::Recursos()->JQuery();
Sis::Recursos()->Bootstrap3();
Sis::Recursos()->AwesomeFont();
Sis::Recursos()->Js('personalizados');
Sis::Recursos()->recursoCss(['url' => Sis::UrlRecursos() . 'librerias/lobibox/css/animate.css']);
Sis::Recursos()->recursoCss(['url' => Sis::UrlRecursos() . 'librerias/lobibox/css/lobibox.css']);
Sis::Recursos()->recursoCss(['url' => Sis::UrlRecursos() . 'librerias/Trumbowyg/ui/trumbowyg.css']);
Sis::Recursos()->recursoJs(['url' => Sis::UrlRecursos() . 'librerias/lobibox/js/lobibox.js']);
Sis::Recursos()->recursoJs(['url' => Sis::UrlRecursos() . 'librerias/lobibox/js/notifications.js']);
Sis::Recursos()->recursoJs(['url' => Sis::UrlRecursos() . 'librerias/Trumbowyg/trumbowyg.js']);
$url = Sis::ap()->getTema()->getUrlBase();
Sis::Recursos()->recursoCss(['url' => $url . "/css/animate.css"]);
Sis::Recursos()->recursoCss(['url' => $url . "/css/form.css"]);
Sis::Recursos()->recursoCss(['url' => $url . "/css/style.css"]);
Sis::Recursos()->recursoCss(['url' => $url . "/css/icons.css"]);
Sis::Recursos()->recursoCss(['url' => $url . "/css/generics.css"]);
Sis::Recursos()->recursoJs(['url' => $url . "/js/jquery.easing.1.3.js"]);
Sis::Recursos()->recursoJs(['url' => $url . "/js/icheck.js"]);
Sis::Recursos()->recursoJs(['url' => $url . "/js/scroll.min.js"]);
Sis::Recursos()->css('estilos');
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title><?= $this->tituloPagina ?></title>
        <meta charset="<?php echo Sis::apl()->charset; ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <meta name="format-detection" content="telephone=no">
        <link rel="icon" href="<?= Sis::UrlRecursos() ?>pics/logo.ico">
    </head>
    <body id="skin-cloth">
        <section id="login">        
            <div class="clearfix"></div>            
            <!-- Login -->
            <?= $this->contenido ?>
        </section>                      
        <?php if(Sis::Sesion()->hayFlash("alerta")): ?>
        <script>
            <?php 
            $flash = Sis::Sesion()->getFlash("alerta");
            ?>
            jQuery(function(){
                Lobibox.notify('<?= isset($flash['tipo'])? $flash['tipo'] : 'default' ?>',{
                    size: 'mini',
                    showClass: '<?= isset($flash['animEntrada'])? $flash['animEntrada'] : 'bounceInRight' ?>',
                    hideClass: '<?= isset($flash['animSalida'])? $flash['animSalida'] : 'bounceOutRight' ?>',
                    msg:'<?= isset($flash['msg'])? $flash['msg'] : '' ?>',
                    delay: 8000,
                    soundPath: '<?= Sis::UrlRecursos() ?>librerias/lobibox/sounds/',
                });
            });           
        </script>
        <?php endif ?>
        <script>

            function lobiAlert(tipo, mensaje){
                 // lobibox-notify-success animated-fast bounceInRight notify-mini
                $(".lobibox-notify").remove();
                var nchars = mensaje.length;
                if(nchars < 70){
                    s = 'mini';
                } else if(nchars >= 70 && nchars < 140){
                    s = 'normal';
                } else if(nchars >= 140){
                    s = 'large';
                }

                Lobibox.notify(tipo, {
                    size: s,
                    showClass: 'bounceInRight',
                    hideClass: 'bounceOutRight',
                    msg:mensaje,
                    delay: 8000,
                    soundPath: '<?= Sis::UrlRecursos() ?>librerias/lobibox/sounds/',
                });
            }
            $(function(){
                setTimeout(function(){
                    $('form#login').addClass('toggled');
                }, 200);
            });
        </script>
    </body>
</html> 
