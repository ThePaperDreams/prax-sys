<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Torneos'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Crear' => ['Torneo/crear'],
        ]
    ];
?>

<div class="row">
    <div class="col-lg-6">
        <a href="<?= Sis::crearUrl(['torneo/generarReporte']) ?>" target="_blank">
        <?php
        $icon=  CBoot::fa('file-pdf-o');
        echo CBoot::boton('Generar pdf '.$icon,'primary',['id'=>'generar_pdf']);
        ?>
        </a>
        </div>
</div>
<div class="p-5"></div>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'Torneo',
    # id_torneo, cupo_maximo, cupo_minimo, edad_maxima, edad_minima, fecha_inicio, fecha_fin, nombre, observaciones, tabla_posiciones, equipo_id
    'columnas' => [
        'nombre',
        'cupo_minimo', 
        'edad_maxima',  
        'fecha_inicio',
    ],
    'opciones' => true,
    'paginacion' => 10,
]) ?>