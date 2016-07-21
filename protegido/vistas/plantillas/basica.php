<?php
# Se importan las librerias base js y css
Sis::Recursos()->JQuery();
Sis::Recursos()->Bootstrap3();
Sis::Recursos()->AwesomeFont();
Sis::Recursos()->Select2();
Sis::Recursos()->JQueryUI();
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
        <?php
        $this->complemento('!siscoms.bootstrap3.CBNav', [
            'brand' => Sis::apl()->nombre,
            'elementos' => [
                ['texto' => 'Inicio', 'url' => ['principal/inicio']],
                ['texto' => 'Acerca', 'url' => ['principal/acerca']],
                ['texto' => 'Contacto', 'url' => ['principal/contacto']],
                ['texto' => 'Deportistas/Acudientes', 'elementos' => [
                        ['texto' => 'Acudientes', 'url' => ['Acudiente/inicio']],
                        ['texto' => 'Deportistas', 'url' => ['Deportista/inicio']],
                        ['texto' => 'Documentos', 'url' => ['Documento/inicio']]]],
                ['texto' => 'Usuarios', 'elementos' => [
                        ['texto' => 'Roles', 'url' => ['Rol/inicio']],
                        ['texto' => 'Usuarios', 'url' => ['Usuario/inicio']]]],
                ['texto' => 'Configuración', 'elementos' => [
                        ['texto' => 'Rutas', 'url' => ['Ruta/inicio']],
                        ['texto' => 'Opciones de Menú', 'url' => ['Opmenu/inicio']],
                        ['texto' => 'Tipos de Documentos', 'url' => ['TipoDocumento/inicio']],
                        ['texto' => 'Estados de Deportista', 'url' => ['EstadoDeportista/inicio']],
                        ['texto' => 'Tipos de Identificación', 'url' => ['TipoIdentificacion/inicio']]]],
                [
                    'texto' => (Sis::apl()->usuario->esVisitante ? 'Iniciar sesión' : 'Cerrar sesión'),
                    'url' => ['principal/' . (Sis::apl()->usuario->esVisitante ? 'entrar' : 'salir')]
                ],
            ],
        ]);
        ?>

        <div class="container">
            <div class="page-header">
                <h4><?= $this->tituloPagina ?></h4>
            </div>
            <?php if (count($this->migas) > 0): ?>
            <ol class="breadcrumb">
                    <?php foreach ($this->migas AS $k => $v): ?>
                        <?php if (is_string($k)): ?>
                            <li><a href="<?= Sis::crearUrl($v) ?>"><?= $k ?></a></li>
                        <?php else: ?>
                            <li><?= $v ?></li>
                        <?php endif ?>
                    <?php endforeach ?>
                </ol>
            <?php endif ?>
            <div class="col-sm-<?= count($this->opciones) > 0 ? '9' : '12' ?>">
                <?= $this->contenido; ?>
            </div>
            <div class="col-sm-3">
                <?php if (count($this->opciones)): ?>
                <div class="panel panel-default">
                        <div class="panel-heading text-center">
                            Opciones
                        </div>
                        <div class="list-group">
                            <?php foreach ($this->opciones['elementos'] AS $k => $v): ?>
                                <a href="<?= Sis::crearUrl($v) ?>" class="list-group-item">
                                    <?= $k ?>
                                </a>
                            <?php endforeach ?>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </div>

    </body>
</html>