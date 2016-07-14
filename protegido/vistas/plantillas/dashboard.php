<?php
# Se importan las librerias base js y css
Sis::Recursos()->JQuery(); 
Sis::Recursos()->Bootstrap3();
Sis::Recursos()->AwesomeFont();
Sis::Recursos()->Select2();
Sis::Recursos()->Css('estilos');
Sis::Recursos()->Js('personalizados');
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title><?= Sis::apl()->nombre; ?></title>
        <meta charset="<?php echo Sis::apl()->charset; ?>">
    </head>
    <body>
        <?php $this->complemento('!siscoms.bootstrap3.CBNav', [
            'brand' => Sis::apl()->nombre,
            'elementos' => [
                ['texto' => 'Inicio', 'url' => ['principal/inicio']],
                ['texto' => 'Ejemplo', 'url' => ['principal/ejemplo']],
                ['texto' => 'Acerca', 'url' => ['principal/acerca']],
                ['texto' => 'Contacto', 'url' => ['principal/contacto']],
                [
                    'texto' => (Sis::apl()->usuario->esVisitante? 'Iniciar sesión' : 'Cerrar sesión'),
                    'url' => ['principal/' . (Sis::apl()->usuario->esVisitante? 'entrar' : 'salir')]
                ], 
            ],
        ]); ?>
        
        <div class="container">
            <?php if(count($this->migas) > 0): ?>
            <ol class="breadcrumb">
                <?php foreach($this->migas AS $k=>$v): ?>
                    <?php if(is_string($k)): ?>
                <li><a href="<?= Sis::crearUrl($v) ?>"><?= $k ?></a></li>
                    <?php else: ?>
                <li><?= $v ?></li>
                    <?php endif ?>
                <?php endforeach ?>
            </ol>
            <?php endif ?>
        <?= $this->contenido; ?>
        </div>
        
    </body>
</html>