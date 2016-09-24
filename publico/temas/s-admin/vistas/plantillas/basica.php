<?php
# Se importan las librerias base js y css
Sis::Recursos()->JQuery();
Sis::Recursos()->Bootstrap3();
Sis::Recursos()->AwesomeFont();
Sis::Recursos()->Select2();
Sis::Recursos()->JQueryUI();
Sis::Recursos()->Js('personalizados');
Sis::Recursos()->recursoCss(['url' => Sis::UrlRecursos() . 'librerias/lobibox/css/animate.css']);
Sis::Recursos()->recursoCss(['url' => Sis::UrlRecursos() . 'librerias/lobibox/css/lobibox.css']);
Sis::Recursos()->recursoCss(['url' => Sis::UrlRecursos() . 'librerias/Trumbowyg/ui/trumbowyg.css']);
Sis::Recursos()->recursoJs(['url' => Sis::UrlRecursos() . 'librerias/lobibox/js/lobibox.js']);
Sis::Recursos()->recursoJs(['url' => Sis::UrlRecursos() . 'librerias/lobibox/js/notifications.js']);
Sis::Recursos()->recursoJs(['url' => Sis::UrlRecursos() . 'librerias/Trumbowyg/trumbowyg.js']);
Sis::Recursos()->recursoJs(['url' => Sis::UrlRecursos() . "/librerias/air-datepicker/js/datepicker.min.js"]);
Sis::Recursos()->recursoJs(['url' => Sis::UrlRecursos() . "/librerias/air-datepicker/js/i18n/datepicker.es.js"]);
Sis::Recursos()->recursoCss(['url' => Sis::UrlRecursos() . "/librerias/air-datepicker/css/datepicker.min.css"]);


$url = Sis::ap()->getTema()->getUrlBase();
Sis::Recursos()->recursoCss(['url' => $url . "/css/animate.css"]);
Sis::Recursos()->recursoCss(['url' => $url . "/css/form.css"]);
Sis::Recursos()->recursoCss(['url' => $url . "/css/calendar.css"]);
Sis::Recursos()->recursoCss(['url' => $url . "/css/style.css"]);
Sis::Recursos()->recursoCss(['url' => $url . "/css/icons.css"]);
Sis::Recursos()->recursoCss(['url' => $url . "/css/generics.css"]);
Sis::Recursos()->recursoJs(['url' => $url . "/js/jquery.easing.1.3.js"]);
Sis::Recursos()->recursoJs(['url' => $url . "/js/charts/jquery.flot.js"]);
Sis::Recursos()->recursoJs(['url' => $url . "/js/charts/jquery.flot.time.js"]);
Sis::Recursos()->recursoJs(['url' => $url . "/js/charts/jquery.flot.animator.min.js"]);
Sis::Recursos()->recursoJs(['url' => $url . "/js/charts/jquery.flot.resize.min.js"]);
Sis::Recursos()->recursoJs(['url' => $url . "/js/sparkline.min.js"]);
Sis::Recursos()->recursoJs(['url' => $url . "/js/easypiechart.js"]);
Sis::Recursos()->recursoJs(['url' => $url . "/js/charts.js"]);
Sis::Recursos()->recursoJs(['url' => $url . "/js/datetimepicker.min.js"]);
Sis::Recursos()->recursoJs(['url' => $url . "/js/maps/jvectormap.min.js"]);
Sis::Recursos()->recursoJs(['url' => $url . "/js/maps/usa.js"]);
Sis::Recursos()->recursoJs(['url' => $url . "/js/icheck.js"]);
Sis::Recursos()->recursoJs(['url' => $url . "/js/scroll.min.js"]);
Sis::Recursos()->recursoJs(['url' => $url . "/js/calendar.min.js"]);
Sis::Recursos()->recursoJs(['url' => $url . "/js/feeds.min.js"]);
Sis::Recursos()->recursoJs(['url' => $url . "/js/functions.js"]);
Sis::Recursos()->recursoJs(['url' => $url . "/js/editor.min.js"]);
Sis::Recursos()->css('estilos');
Sis::Recursos()->Js('comunes');
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
        <header id="header" class="media">
            <a href="#" id="menu-toggle"></a> 
            <a class="logo pull-left" href="<?= Sis::UrlBase() ?>"><?= Sis::apl()->nombre ?></a>

            <div class="media-body">
                <div class="media" id="top-menu">
                    <div class="pull-left tm-icon">
                        <a data-drawer="messages" class="drawer-toggle" href="#">
                            <i class="sa-top-message"></i>
                            <i class="n-count animated">5</i>
                            <span>Messages</span>
                        </a>
                    </div>
                    <div class="pull-left tm-icon">
                        <a data-drawer="notifications" class="drawer-toggle" href="#">
                            <i class="sa-top-updates"></i>
                            <i class="n-count animated">9</i>
                            <span>Updates</span>
                        </a>
                    </div>


                    <div id="time" class="pull-right">
                        <span id="hours"></span>
                        :
                        <span id="min"></span>
                        :
                        <span id="sec"></span>
                    </div>

                    <div class="media-body">
                        <input type="text" class="main-search">
                    </div>
                </div>
            </div>
        </header>
        
        <div class="clearfix"></div>
        
        <section id="main" class="p-relative" role="main">
            <aside id="sidebar">
                <!-- Sidbar Widgets -->
                <div class="side-widgets overflow">
                    <!-- Profile Menu -->
                    <div class="text-center s-widget m-b-25 dropdown" id="profile-menu">
                        <a href="#" data-toggle="dropdown">
                            <img class="profile-pic animated" id="foto-perfil" src="<?= Sis::apl()->usuario->getFoto(true) ?>" alt="">
                        </a>
                        <ul class="dropdown-menu profile-menu">
                            <li><a href="<?= Sis::UrlBase() . Sis::apl()->usuario->getID()?>/Usuario/verPerfil">Mi perfíl</a> <i class="icon left">&#61903;</i><i class="icon right">&#61815;</i></li>
                            <li><a href="<?= Sis::crearUrl(['principal/salir']) ?>">Salir</a> <i class="icon left">&#61903;</i><i class="icon right">&#61815;</i></li>
                        </ul>
                        <h4 class="m-0"><?= Sis::apl()->usuario->usuario ?></h4>
                    </div>

                    <!-- Calendar -->
                    <div class="s-widget m-b-25">
                        <div id="sidebar-calendar"></div>
                    </div>
                    
                </div>
        <?php $this->complemento('!raiz.publico.temas.s-admin.complementos.CSAdminSideNav', [
            'brand' => Sis::apl()->nombre,
            'elementos' => [
                ['texto' => '', 'url' => ['principal/inicio'], 'fa' => 'home'],
                ['texto' => 'Deportistas', 'fa' => 'male', 'elementos' => [
                    ['texto' => 'Acudientes', 'url' => ['Acudiente/inicio']],
                    ['texto' => 'Deportistas', 'url' => ['Deportista/inicio']],                        
                    ['texto' => 'Documentos', 'url' => ['Documento/inicio']],
                ]],
                ['texto' => 'Formación', 'fa' => 'soccer-ball-o', 'elementos' => [
                    ['texto' => 'Categorías de deportistas', 'url' => ['categoria/inicio']],
                    ['texto' => 'Matriculas', 'url' => ['Matricula/inicio']],
                    ['texto' => 'Lista de espera', 'url' => ['Deportista/verListaEspera']],
                    ['texto' => 'Planes de Trabajo', 'url' => ['PlanTrabajo/inicio']],
                    ['texto' => 'Asistencia', 'url' => ['asistencia/inicio']],
                    ['texto' => 'Objetivos', 'url' => ['objetivo/inicio']],
                    ['texto' => 'Préstamo de deportistas', 'url' => ['PrestamoDeportista/inicio']],
                ]],
                ['texto' => 'Control existencias', 'fa' => 'cubes', 'elementos' => [
                    ['texto' => 'Categoría implementos', 'url' => ['categoriaImplemento/inicio']],
                    ['texto' => 'Implementos', 'url' => ['implemento/inicio']],
                    ['texto' => 'Entradas', 'url' => ['entrada/inicio']],
                    ['texto' => 'Salidas', 'url' => ['salida/inicio']],
                ]],                
                ['texto' => 'Pagos', 'fa' => 'money', 'elementos' => [
                    ['texto' => 'Pagos pendientes', 'url' => ['Pago/pagosPendientes']],
                    ['texto' => 'Consultar pagos', 'url' => ['pago/consultar']],
                ]],
                ['texto' => 'Torneos', 'fa' => 'trophy', 'elementos' => [
                    ['texto' => 'Torneos', 'url' => ['torneo/inicio']],
                    ['texto' => 'Registrar torneo', 'url' => ['torneo/crear']],
                ]],                
                ['texto' => 'Publicaciones', 'fa' => 'newspaper-o', 'elementos' => [
                    ['texto' => 'Publicación', 'url' => ['publicacion/inicio']],
                    ['texto' => 'Tipos de publicación', 'url' => ['tipoPublicacion/inicio']],
                    ['texto' => 'Eventos', 'url' => ['Evento/inicio']],
                    ['texto' => 'Tipo de Eventos', 'url' => ['tipoEvento/inicio']],
                    ['texto' => 'Imágenes', 'url' => ['Publicacion/cargarImagenes']],
                    
                ]],
                ['texto' => 'Usuarios', 'fa' => 'users', 'elementos' => [
                        ['texto' => 'Roles', 'url' => ['Rol/inicio']],
                        ['texto' => 'Usuarios', 'url' => ['Usuario/inicio']]
                ]],
                ['texto' => 'Configuración', 'fa' => 'cogs', 'elementos' => [
                        ['texto' => 'Rutas', 'url' => ['Ruta/inicio']],
                        ['texto' => 'Opciones de Menú', 'url' => ['Opmenu/inicio']],
                        ['texto' => 'Tipos de Documentos', 'url' => ['TipoDocumento/inicio']],
                        ['texto' => 'Estados de Deportista', 'url' => ['EstadoDeportista/inicio']],
                        ['texto' => 'Tipos de Identificación', 'url' => ['TipoIdentificacion/inicio']],
                        ['texto' => 'Permisos', 'url' => ['Permiso/asignar']],
                ]],
            ],
            'menuDerecha' => [
                [
                    'texto' => (Sis::apl()->usuario->esVisitante? 'Iniciar sesión' : "(" . Sis::apl()->usuario->usuario . ') Cerrar sesión'),
                    'url' => ['principal/' . (Sis::apl()->usuario->esVisitante? 'entrar' : 'salir')]
                ], 
            ],
        ]); ?>
            </aside>            
            <section id="content" class="container">
                <div class="page-header">
                    <h4><?= $this->tituloPagina ?></h4>
                    <?php if($this->ayuda != ""): ?>
                    <span id="icono-ayuda">
                        <i class="fa fa-question-circle" title="Ayuda" data-help="<?= $this->ayuda ?>" data-help-title="<?= $this->ayudaTitulo ?>"></i>
                    </span>
                    <?php endif ?>
                </div>
                <?php $this->complemento('!siscoms.bootstrap3.CBBreadCrumbs', [
                    'migas' => $this->migas
                ]) ?>
                <div class="col-sm-12">                    
                    <?= $this->seccion("antes-de-opciones") ?>
                </div>
                
                <div class="col-sm-<?= count($this->opciones) > 0? '9' : '12' ?>">
                    <?= $this->contenido; ?>
                </div>
                <?php if(count($this->opciones)): ?>
                <div class="col-sm-3">
                    <?php $this->complemento('!siscoms.bootstrap3.CBOpcionesPanel', [
                        'opciones' => $this->opciones,
                    ]) ?>
                </div>
                <?php endif ?>
            </section>            
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
                Lobibox.notify(tipo, {
                    size: 'mini',
                    showClass: 'bounceInRight',
                    hideClass: 'bounceOutRight',
                    msg:mensaje,
                    delay: 8000,
                    soundPath: '<?= Sis::UrlRecursos() ?>librerias/lobibox/sounds/',
                });
            }
            $(function(){
                $("#icono-ayuda i").click(function(){
                    var ayuda = $(this).attr("data-help");
                    var ayudaTitulo = $(this).attr("data-help-title");
                    if(!ayudaTitulo){
                        ayudaTitulo = "Ayuda";
                    }
                    $.ajax({
                        type: 'POST',
                        url: '<?= Sis::CrearUrl(['Ayuda/getAyuda']) ?>',
                        data: {
                            'ayuda': ayuda,
                        },
                        success: function(obj){
                            abrirCortinaAyuda(ayudaTitulo, obj.body);
                        }
                    });
                    
                });
            });
            
//            function traerAyuda(ayuda){
//                
////                $.ajax({
////                    
////                });
//            }
            
            function abrirCortinaAyuda(title, body){                
                var html = '<div id="cortina-ayuda" class="cortina" style="display:none">' + 
                                '<div class="p-modal" style="display:none">' + 
                                    '<div class="p-modal-header">' +                                         
                                    title + 
                                    '</div>' + 
                                    '<div class="p-modal-body">' + 
                                    body +
                                    '</div>' +
                                    '<div class="p-modal-footer">' + 
                                        '<button id="btn-close-window" class="btn btn-primary">Salir</button>' + 
                                    '</div>' + 
                                '</div>' + 
                            '</div>';
                $("body").append(html);
                var cortina = $("#cortina-ayuda");
                var modal = cortina.find(".p-modal");
                var wh = $(window).height();
                var offset = wh * 0.1;
                var modalH = 0;
                var closeWindow = function(){
                    modal.animate({
                        top: (offset + 100) + "px",
                    }, 100).animate({
                        top: -modalH + 'px',
                    }, 200, function(){
                        cortina.fadeOut(function(){
                            cortina.remove();
                            $("body").css({
                                'overflow': 'auto',
                            });
                        });
                    });
                };
                
                cortina.fadeIn(function(){                    
                    modalH = modal.height();
                    modal.css({
                        top: -modalH + "px",
                        display: 'inherit',
                    });
                    modal.animate({
                        top: (offset) + 'px',
                    });
                });
                
                cortina.click(function(){                    
                   closeWindow();
                });
                
                modal.click(function(e){
                    e.stopPropagation();
                });
                var button = $("#btn-close-window");
                button.click(function(){
                    closeWindow();
                });
                $("body").css({
                    'overflow': 'hidden',
                });
            }
                
        </script>
        
    </body>
</html>
