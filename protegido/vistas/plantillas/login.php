<?php
# Se importan las librerias base js y css
Sis::Recursos()->JQuery(); 
Sis::Recursos()->Bootstrap3();
Sis::Recursos()->AwesomeFont();
Sis::Recursos()->css('estilos');
Sis::Recursos()->Js('personalizados');
Sis::Recursos()->recursoCss([
    'alias' => 'lobibox-animate',
    'url' => Sis::UrlRecursos() . 'librerias/lobibox/css/animate.css',
]);
Sis::Recursos()->recursoCss([
    'alias' => 'lobibox',
    'url' => Sis::UrlRecursos() . 'librerias/lobibox/css/lobibox.css',
]);
Sis::Recursos()->recursoJs([
    'alias' => 'lobibox',
    'url' => Sis::UrlRecursos() . 'librerias/lobibox/js/lobibox.js',
]);
Sis::Recursos()->recursoJs([
    'alias' => 'lobibox-notifications',
    'url' => Sis::UrlRecursos() . 'librerias/lobibox/js/notifications.js',
]);
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title><?= $this->tituloPagina ?></title>
        <meta charset="<?php echo Sis::apl()->charset; ?>">
        
    </head>
    <body>
        <?php $this->complemento('!siscoms.bootstrap3.CBNav', [
            'brand' => Sis::apl()->nombre,
            'menuDerecha' => [
                [
                    'texto' => (Sis::apl()->usuario->esVisitante? 'Iniciar sesión' : "(" . Sis::apl()->usuario->usuario . ') Cerrar sesión'),
                    'url' => ['principal/' . (Sis::apl()->usuario->esVisitante? 'entrar' : 'salir')]
                ], 
            ]
        ]); ?>
        
        <div class="container">
            <div class="col-sm-12">
                <?= $this->contenido; ?>
            </div>            
        </div>
        
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
    </body>
</html> 