<?php 
$this->tituloPagina = "Prax-sys";
 ?>
<!-- Notification Drawer -->
<!-- Breadcrumb -->
<!--<ol class="breadcrumb hidden-xs">
    <li><a href="#">Home</a></li>
    <li><a href="#">Library</a></li>
    <li class="active">Data</li>
</ol>-->

<!-- <h4 class="page-title">DASHBOARD</h4>
 -->
<!-- Shortcuts -->
<div class="block-area shortcut-area">
    <a class="shortcut tile" href="<?= Sis::crearUrl(['deportista/inicio']) ?>">
        <!--<img src="<?= Sis::ap()->getTema()->getUrlBase() ?>/img/shortcuts/money.png" alt="">-->
        <i class="fa fa-male"></i>
        <small class="t-overflow">Deportista</small>
    </a>
<!--    <a class="shortcut tile" href="#">
        <img src="<?= Sis::ap()->getTema()->getUrlBase() ?>/img/shortcuts/twitter.png" alt="">
        <i class="fa fa-soccer-ball-o"></i>
        <small class="t-overflow">Formación</small>
    </a>-->
<!--    <a class="shortcut tile" href="#">
        <img src="<?= Sis::ap()->getTema()->getUrlBase() ?>/img/shortcuts/calendar.png" alt="">
        <i class="fa fa-cubes"></i>
        <small class="t-overflow">Implementos</small>
    </a>-->
    <a class="shortcut tile" href="<?= Sis::crearUrl(['pago/pagosPendientes']) ?>">
        <!--<img src="<?= Sis::ap()->getTema()->getUrlBase() ?>/img/shortcuts/stats.png" alt="">-->
        <i class="fa fa-money"></i>
        <small class="t-overflow">Pagos</small>
    </a>
    <a class="shortcut tile" href="<?= Sis::crearUrl(['publicacion/inicio']) ?>">
        <!--<img src="<?= Sis::ap()->getTema()->getUrlBase() ?>/img/shortcuts/connections.png" alt="">-->
        <i class="fa fa-newspaper-o"></i>
        <small class="t-overflow">Noticias</small>
    </a>
    <a class="shortcut tile" href="<?= Sis::crearUrl(['evento/inicio']) ?>">
        <!--<img src="<?= Sis::ap()->getTema()->getUrlBase() ?>/img/shortcuts/connections.png" alt="">-->
        <i class="fa fa-calendar-check-o"></i>
        <small class="t-overflow">Eventos</small>
    </a>
    <a class="shortcut tile" href="<?= Sis::crearUrl(['usuario/suscriptores']) ?>">
        <!--<img src="<?= Sis::ap()->getTema()->getUrlBase() ?>/img/shortcuts/connections.png" alt="">-->
        <i class="fa fa-users"></i>
        <small class="t-overflow">Suscritos</small>
    </a>
    <a class="shortcut tile" href="#">
        <img src="<?= Sis::ap()->getTema()->getUrlBase() ?>/img/shortcuts/reports.png" alt="">
        <small class="t-overflow">Reportes</small>
    </a>
</div>

<hr class="whiter" />

<!-- Quick Stats -->
<div class="block-area">
    <div class="row">
        <div class="col-md-3 col-xs-6">
            <div class="tile quick-stats">
                <div id="stats-line-2" class="pull-left"></div>
                <div class="data">
                    <h2 data-value="<?= Sis::ap()->Utilidades->visitasHoy() ?>">0</h2>
                    <small>Visitas hoy</small>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-xs-6">
            <div class="tile quick-stats media">
                <div id="stats-line-3" class="pull-left"></div>
                <div class="media-body">
                    <h2 data-value="<?= Sis::ap()->Utilidades->visitasMes() ?>">0</h2>
                    <small>Visitas este mes</small>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-xs-6">
            <div class="tile quick-stats media">

                <div id="stats-line-4" class="pull-left"></div>

                <div class="media-body">
                    <h2 data-value="<?= Sis::ap()->Utilidades->comentariosSinAprobar() ?>">0</h2>
                    <small>Comentarios sin aprobar</small>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-xs-6">
            <div class="tile quick-stats media">
                <div id="stats-line" class="pull-left"></div>
                <div class="media-body">
                    <h2 data-value="<?= Sis::ap()->Utilidades->getEventos() ?>">0</h2>
                    <small>Eventos proximos</small>
                </div>
            </div>
        </div>

    </div>

</div>

<div class="block-area">
    <div class="tile">
        <h2 class="tile-title">Visitas</h2>
        <div class="tile-config dropdown">
            
        </div>
        <div class="p-10">
            <!-- <div id="line-chart-visitas" style="height: 250px; padding: 0px; position: relative;">     
            </div>   -->          
            <canvas id="myChart" width="400" height="100"></canvas>
        </div>  
    </div>
</div>
<script>
    $(function(){
        // setTimeout(function(){

            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [<?= $labels ?>],
                    datasets: [{
                        label: 'Visitas',
                        data: [<?= $data ?>],
                        backgroundColor: 'rgba(255, 255, 255, 0.2)',
                        borderColor: 'rgba(255,255,255,1)',
                        borderWidth: 1,
                        borderCapStyle: 'butt',
                    }]
                },

            });

        // }, 100);

    });
</script>

<hr class="whiter" />

<script>
    $(function(){
        if ($('#line-chart-visitas')[0]) {
            var d1 = [[1,14], [2,15], [3,18], [4,16], [5,19], [6,17], [7,15], [8,16], [9,20], [10,16], [11,18], [12,30]];

            $.plot('#line-chart-visitas', [ {
                data: d1,
                label: "Data",

            },],

                {
                    series: {
                        lines: {
                            show: true,
                            lineWidth: 1,
                            fill: 0.25,
                        },

                        color: 'rgba(255,255,255,0.7)',
                        shadowSize: 0,
                        points: {
                            show: true,
                        }
                    },

                    yaxis: {
                        min: 10,
                        max: 22,
                        tickColor: 'rgba(255,255,255,0.15)',
                        tickDecimals: 0,
                        font :{
                            lineHeight: 13,
                            style: "normal",
                            color: "rgba(255,255,255,0.8)",
                        },
                        shadowSize: 0,
                    },
                    xaxis: {
                        tickColor: 'rgba(255,255,255,0)',
                        tickDecimals: 0,
                        font :{
                            lineHeight: 13,
                            style: "normal",
                            color: "rgba(255,255,255,0.8)",
                        }
                    },
                    grid: {
                        borderWidth: 1,
                        borderColor: 'rgba(255,255,255,0.25)',
                        labelMargin:10,
                        hoverable: true,
                        clickable: true,
                        mouseActiveRadius:6,
                    },
                    legend: {
                        show: false
                    }
                });

            $("#line-chart-visitas").bind("plothover", function (event, pos, item) {
                if (item) {
                    var x = item.datapoint[0].toFixed(2),
                        y = item.datapoint[1].toFixed(2);
                    $("#linechart-tooltip").html(item.series.label + " of " + x + " = " + y).css({top: item.pageY+5, left: item.pageX+5}).fadeIn(200);
                }
                else {
                    $("#linechart-tooltip").hide();
                }
            });

            $("<div id='linechart-tooltip' class='chart-tooltip'></div>").appendTo("body");
        }
    });
</script>