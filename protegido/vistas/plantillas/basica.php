<?php
# Se importan las librerias base js y css
Sis::Recursos()->JQuery();
Sis::Recursos()->Bootstrap3();
Sis::Recursos()->AwesomeFont();
Sis::Recursos()->Select2();
Sis::Recursos()->JQueryUI();
Sis::Recursos()->css('estilos');
Sis::Recursos()->Js('personalizados');
Sis::Recursos()->Js('comunes');
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
            'elementos' => [
                ['texto' => 'Inicio', 'url' => ['principal/inicio']],
                ['texto' => 'Formación', 'elementos' => [
                    ['texto' => 'Objetivos', 'url' => ['objetivo/inicio']],
                    ['texto' => 'Planes de Trabajo', 'url' => ['PlanTrabajo/inicio']],
                    ['texto' => 'Matriculas', 'url' => ['Matricula/inicio']],
                    ['texto' => 'Asistencia', 'url' => ['asistencia/inicio']],
                ]],
                ['texto' => 'Control existencias', 'elementos' => [
                    ['texto' => 'Categoría implementos', 'url' => ['categoriaImplemento/inicio']],
                    ['texto' => 'Implementos', 'url' => ['implemento/inicio']],
                    ['texto' => 'Entradas', 'url' => ['entrada/inicio']],
                    ['texto' => 'Salidas', 'url' => ['salida/inicio']],
                ]],
                ['texto' => 'Deportistas/Acudientes', 'elementos' => [
                        ['texto' => 'Acudientes', 'url' => ['Acudiente/inicio']],
                        ['texto' => 'Deportistas', 'url' => ['Deportista/inicio']],
                        ['texto' => 'Documentos', 'url' => ['Documento/inicio']]
                ]],
                ['texto' => 'Torneos', 'elementos' => [
                    ['texto' => 'Torneos', 'url' => ['torneo/inicio']],
                    ['texto' => 'Equipos', 'url' => ['Equipo/inicio']],                    
                ]],
                ['texto' => 'Usuarios', 'elementos' => [
                        ['texto' => 'Roles', 'url' => ['Rol/inicio']],
                        ['texto' => 'Usuarios', 'url' => ['Usuario/inicio']]
                ]],
                ['texto' => 'Configuración', 'elementos' => [
                        ['texto' => 'Rutas', 'url' => ['Ruta/inicio']],
                        ['texto' => 'Opciones de Menú', 'url' => ['Opmenu/inicio']],
                        ['texto' => 'Tipos de Documentos', 'url' => ['TipoDocumento/inicio']],
                        ['texto' => 'Estados de Deportista', 'url' => ['EstadoDeportista/inicio']],
                        ['texto' => 'Tipos de Identificación', 'url' => ['TipoIdentificacion/inicio']]
                ]],
                ['texto' => 'Publicaciones', 'elementos' => [
                    ['texto' => 'Publicación', 'url' => ['publicacion/inicio']],
                    ['texto' => 'Tipos de publicación', 'url' => ['tipoPublicacion/inicio']],
                    ['texto' => 'Eventos', 'url' => ['Evento/inicio']],
                    ['texto' => 'Tipo de Eventos', 'url' => ['tipoEvento/inicio']],
                    ['texto' => 'Imágenes', 'url' => ['Publicacion/cargarImagenes']],
                    
                ]],
            ],
            'menuDerecha' => [
                [
                    'texto' => (Sis::apl()->usuario->esVisitante? 'Iniciar sesión' : "(" . Sis::apl()->usuario->usuario . ') Cerrar sesión'),
                    'url' => ['principal/' . (Sis::apl()->usuario->esVisitante? 'entrar' : 'salir')]
                ], 
            ],
        ]); ?>
        
        <div class="container">            
            <div class="page-header">
                <h4><?= $this->tituloPagina ?></h4>
            </div>
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
            <div class="col-sm-<?= count($this->opciones) > 0? '9' : '12' ?>">
                <?= $this->contenido; ?>
            </div>
            <?php if(count($this->opciones)): ?>
            <div class="col-sm-3">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        Opciones
                    </div>
                    <div class="list-group">
                    <?php foreach($this->opciones['elementos'] AS $k=>$v): ?>
                        <a href="<?= Sis::crearUrl($v) ?>" class="list-group-item">
                            <?= $k ?>
                        </a>
                    <?php endforeach ?>
                    </div>
                </div>
            </div>
            <?php endif ?>
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
        <input type="hidden" value="13" id="elemento">
        <?php endif ?>
    </body>
</html> 
