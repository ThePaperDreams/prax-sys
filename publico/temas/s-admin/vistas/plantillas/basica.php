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
// Sis::Recursos()->recursoCss(['url' => Sis::UrlRecursos() . 'librerias/Trumbowyg/ui/trumbowyg.css']);
Sis::Recursos()->recursoJs(['url' => Sis::UrlRecursos() . 'librerias/lobibox/js/lobibox.js']);
Sis::Recursos()->recursoJs(['url' => Sis::UrlRecursos() . 'librerias/lobibox/js/notifications.js']);
// Sis::Recursos()->recursoJs(['url' => Sis::UrlRecursos() . 'librerias/Trumbowyg/trumbowyg.js']);
// Sis::Recursos()->recursoJs(['url' => Sis::UrlRecursos() . "/librerias/air-datepicker/js/datepicker.js"]);
// Sis::Recursos()->recursoJs(['url' => Sis::UrlRecursos() . "/librerias/air-datepicker/js/i18n/datepicker.es.js"]);
// Sis::Recursos()->recursoCss(['url' => Sis::UrlRecursos() . "/librerias/air-datepicker/css/datepicker.min.css"]);
// Sis::Recursos()->recursoCss(['url' => Sis::UrlRecursos() . 'librerias/uikit/css/uikit.css']);

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
// Sis::Recursos()->recursoJs(['url' => $url . "/js/datetimepicker.min.js"]);
Sis::Recursos()->recursoJs(['url' => $url . "/js/maps/jvectormap.min.js"]);
Sis::Recursos()->recursoJs(['url' => $url . "/js/maps/usa.js"]);
// Sis::Recursos()->recursoJs(['url' => $url . "/js/icheck.js"]);
Sis::Recursos()->recursoJs(['url' => $url . "/js/scroll.min.js"]);
Sis::Recursos()->recursoJs(['url' => $url . "/js/calendar.min.js"]);
Sis::Recursos()->recursoJs(['url' => $url . "/js/feeds.min.js"]);
Sis::Recursos()->recursoJs(['url' => $url . "/js/functions.js"]);
Sis::Recursos()->recursoJs(['url' => $url . "/js/editor.min.js"]);
Sis::Recursos()->css('estilos');
Sis::Recursos()->Js('comunes');

Sis::Recursos()->recursoCss(['url' => Sis::UrlRecursos() . '/librerias/bootstrap-switch/bootstrap-switch.css']);
Sis::Recursos()->recursoJs(['url' => Sis::UrlRecursos() . '/librerias/bootstrap-switch/bootstrap-switch.js']);
Sis::Recursos()->recursoCss(['url' => Sis::UrlRecursos() . "/librerias/bootstrap-datepicker/css/datepicker.css"]);
Sis::Recursos()->recursoJs(['url' => Sis::UrlRecursos() . "/librerias/bootstrap-datepicker/js/bootstrap-datepicker.js"]);
Sis::Recursos()->recursoJs(['url' => Sis::UrlRecursos() . '/librerias/chartjs/Chart.js']);
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
            <a class="logo pull-left" href="<?= Sis::UrlBase() ?>">
                <img class="logo-brand" src="<?= Sis::UrlRecursos() ?>pics/logo-brand.png" alt="">
                <?= strtoupper(Sis::apl()->nombre) ?>            
            </a>

            <div class="media-body">
                <div class="media" id="top-menu">
                    <div class="pull-left tm-icon">
                    <?php if (count(Sis::ap()->Utilidades->getNotificaciones()) > 0 )  : ?>                        
                        <a id="notifications-icon" data-drawer="notifications" class="drawer-toggle" href="#">
                    <?php else: ?>
                        <a id="notifications-icon" data-drawer="notifications" class="drawer-toggle" href="#" style="display:none;">
                    <?php endif ?>
                            <i class="sa-top-updates"></i>
                            <i class="n-count animated"><?= count(Sis::ap()->Utilidades->getNotificaciones()) ?></i>
                            <span>Notificaciones</span>
                        </a>
                    </div>


                    <!-- <div id="time" class="pull-right">
                        <span id="hours"></span>
                        :
                        <span id="min"></span>
                        :
                        <span id="sec"></span>
                    </div> -->

                    <!-- <div class="media-body">
                        <input type="text" class="main-search">
                    </div> -->
                    <div class="pull-right">
                        <div class="row">
                            <div class="dropdown dropdown-mas">
                                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    Información <i class="fa fa-info-circle"></i>
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="<?= Sis::crearUrl(['principal/sobre']) ?>">Acerca de</a></li>
                                    <li><a href="<?= Sis::crearUrl(['principal/mapaNavegacion']) ?>">Mapa de navegación</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        
        <div class="clearfix"></div>
        
        <section id="main" class="p-relative" role="main">
            <div id="configs" style="display: none">
                <input type="hidden" id="max-date-range" value="<?= Configuracion::get('max_date_range') ?>">
            </div>
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
                    ['texto' => 'Asistencia', 'url' => ['asistencia/inicio']],
                    ['texto' => 'Lista de espera', 'url' => ['Deportista/verListaEspera']],
                    ['texto' => 'Planes de Trabajo', 'url' => ['PlanTrabajo/inicio']],
                    ['texto' => 'Objetivos', 'url' => ['objetivo/inicio']],
                    ['texto' => 'Préstamo de deportistas', 'url' => ['PrestamoDeportista/inicio']],
                ]],
                ['texto' => 'Control existencias', 'fa' => 'cubes', 'elementos' => [
                    ['texto' => 'Categoría implementos', 'url' => ['categoriaImplemento/inicio']],
                    ['texto' => 'Implementos', 'url' => ['implemento/inicio']],
                    ['texto' => 'Entradas', 'url' => ['entrada/inicio']],
                    ['texto' => 'Préstamo', 'url' => ['salida/inicio']],
                ]],                
                ['texto' => 'Pagos', 'fa' => 'money', 'elementos' => [
                    ['texto' => 'Pagos pendientes', 'url' => ['Pago/pagosPendientes']],
                    ['texto' => 'Pagos realizados', 'url' => ['pago/realizados']],
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
                    ['texto' => 'Imágenes', 'url' => ['Publicacion/imagenes']],                    
                    ['texto' => 'Ir a sitio web', 'url' => ['Publicacion/verSitio'], 'opcionesLink' => ['target' => '_blank']],
                ]],
                ['texto' => 'Usuarios', 'fa' => 'users', 'elementos' => [
                        ['texto' => 'Roles', 'url' => ['Rol/inicio']],
                        ['texto' => 'Usuarios', 'url' => ['Usuario/inicio']],
                        ['texto' => 'Permisos', 'url' => ['Permiso/asignar']],
                ]],
                // ['texto' => 'Reportes', 'fa' => 'bar-chart-o', 'opciones' => ['title' => 'Reportes'], 'elementos' => [
                //     ['texto' => 'Ver reportes', 'url' => ['reportes/todos']]
                // ]],
                ['texto' => 'Configuración', 'fa' => 'cogs', 'elementos' => [
                        ['texto' => 'Configuración General', 'url' => ['principal/configuracion']],
                        // ['texto' => 'Rutas', 'url' => ['Ruta/inicio']],
                        // ['texto' => 'Opciones de Menú', 'url' => ['Opmenu/inicio']],
                        // ['texto' => 'Tipos de Documentos', 'url' => ['TipoDocumento/inicio']],
                        // ['texto' => 'Estados de Deportista', 'url' => ['EstadoDeportista/inicio']],
                        // ['texto' => 'Tipos de Identificación', 'url' => ['TipoIdentificacion/inicio']],
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
                    <span id="icono-ayuda" style="display: none">
                        <i class="fa fa-question-circle" title="Ayuda" data-help="<?= $this->ayuda ?>" data-help-title="<?= $this->ayudaTitulo ?>"></i>
                    </span>
                    <?php endif ?>
                </div>

                <div id="notifications" class="tile drawer animated">
                    <div class="listview narrow">
                        <div class="media">
                            <a href="#">Notificaciones</a>
                            <span class="drawer-close">&times;</span>
                        </div>
                        <div id="contenedor-notificaciones" class="overflow" style="height: 254px">
                            <?php foreach (Sis::ap()->Utilidades->getNotificaciones() as $notificacion): ?>
                                
                            <div class="media notificacion">
                                <div class="pull-left">
                                    <?= CBoot::fa($notificacion['icono']) ?>
                                </div>
                                <div class="media-body">
                                    <a class="t-overflow" href="<?= $notificacion['url'] ?>">
                                        <?= $notificacion['texto'] ?>
                                    </a>
                                </div>
                            </div>

                            <?php endforeach ?>
                            
                        </div>
                    </div>
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
            $(function(){
                if(typeof sessionStorage !== "undefined" ){
                    var mostrarMenu = sessionStorage.getItem("menu-mostrado") || 'false';                    
                    var sideBar = $("aside#sidebar");

                    setTimeout(function(){
                        if(mostrarMenu == 'true'){
                            sideBar.css({overflow: 'hidden'});
                            
                            sideBar.animate({"width": '0px'}, 100, function(){
                                
                                // sideBar.css({overflow: 'inherit'});
                                sideBar.addClass("toggled");
                                setTimeout(function(){
                                    $("html").addClass("menu-active");
                                    sideBar.removeAttr("style");
                                }, 100);

                            });
                        } else {
                            sideBar.removeClass("toggled");
                            $("html").removeClass("menu-active");
                        }
                    }, 1);

                    $("#menu-toggle").click(function(){
                        setTimeout(function(){
                            var toggled = sideBar.hasClass("toggled")? 'true' : 'false';
                            sessionStorage.setItem("menu-mostrado", toggled);
                        }, 10);
                    });
                }

            });

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

            function confirmar(titulo, msg, callback, noCallback){
                callback = callback == undefined? function(){} : callback;
                noCallback = noCallback == undefined? function(){} : noCallback;

                Lobibox.confirm({
                    title: titulo,
                    msg: msg,
                    buttons: {
                        'yes': {'text' : 'Si', 'class' : 'btn btn-success'},
                        'no': {'text' : 'No', 'class' : 'btn btn-default'},
                    },
                    callback: function($this, type, evt){
                        if(type == "yes"){
                            callback($this, type, evt);
                        } else {
                            noCallback($this, type, evt);
                        }
                    }
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

            $(function(){
                setTimeout(function(){
                    revisarEventosCalendario();
                }, 500);
                $(".fc-button").click(function(){
                    revisarEventosCalendario();
                });
            });

            function revisarEventosCalendario(){
                var dias = $(".fc-day");
                var eventos = <?= Sis::apl()->Utilidades->eventosCalendario() ?>;
                console.log(eventos);
                $.each(dias, function(k,v){
                    var dia = $(v);
                    for(var i in eventos){
                        if(dia.attr("data-date") == eventos[i]){
                            dia.addClass("con-eventos");
                            dia.click(function(){
                                mostrarEventosDia(eventos[i]);
                            });
                            break;
                        }
                    }
                });
            }

            function mostrarEventosDia(dia){
                $.ajax({
                    type: 'POST',
                    url: '<?= Sis::crearUrl(['principal/ajx']) ?>',
                    data: {
                        "ajx-rqst" : true,
                        "get-eventos-dia" : true,
                        "dia" : dia,
                    }
                }).done(function(data){
                    if(data.error == false){
                        var modal = $("#modal-eventos");
                        var contenedorEventos = $("#listado-eventos");

                        contenedorEventos.html("");
                        $.each(data.eventos, function(k,v){
                            var tr = $("<tr/>");
                            var a = $("<a/>", {href: v.url, class: 'btn btn-primary', 'title' : 'Ver evento'});
                            var icon = $("<i/>", {'class' : 'fa fa-eye'});
                            a.html(icon);
                            tr.append($("<td/>").html(v.nombre));
                            tr.append($("<td/>").html(v.hora)); 
                            tr.append($("<td/>", {'class': 'text-center'}).append(a));
                            $("#dia-eventos").html(dia);
                            contenedorEventos.append(tr);
                        });
                        modal.modal("show");

                    } else {
                        console.log(data);
                    }
                });
            }

            function consultarNotificaciones(){
                $.ajax({
                    type: 'POST',
                    url: '<?= Sis::crearUrl(['principal/ajx']) ?>',
                    data: {
                        'ajx-rqst' : true,
                    }
                }).done(function(data){
                    var boton = $("#notifications-icon");
                    var contenedor = $("#contenedor-notificaciones");

                    contenedor.html("");
                    
                    if(parseInt(data.total) > 0){
                        boton.show();
                        boton.find(".n-count").html(data.total);

                        $.each(data.notificaciones, function(k,v){
                            var media = $("<div/>", {class: "media notificacion"});
                            var pull = $("<div/>", { class: "pull-left"});
                            var icono = $("<i/>", {class: ""});
                            var body = $("<div/>", {class: "media-body"});
                            var link = $("<a/>", {class: "t-overflow"});
                            link.attr("href", v.url);
                            icono.addClass("fa fa-" + v.icono);
                            link.html(v.texto);
                            body.html(link);
                            pull.html(icono);
                            media.append(pull, body);
                            contenedor.append(media);
                        });
                    } else {
                        boton.hide();
                    }


                });
            }

            $(function(){
                consultarNotificaciones();

                setInterval(function(){
                    consultarNotificaciones();
                }, 6000);
            });

        </script>
        <script>
        $(function(){
            // Lobibox.confirm({
            //     title       : "titulo",
            //     msg         : "Are you sure you want to delete this user?",
                // buttons: {
                //     yes: {text : "Si", class : "btn btn-success"},
                //     no: {text : "No", class: "btn btn-default"},
                // },
                // callback    : function($this, type, evt){
                    
                // }
            // });
        });
        </script>        
        <div class="modal fade" id="modal-eventos">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Día del evento: <span id="dia-eventos"></span></h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Título</th>
                                    <th>Hora</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody id="listado-eventos">
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
