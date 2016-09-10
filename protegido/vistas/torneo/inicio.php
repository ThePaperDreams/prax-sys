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

<?php $this->abrirSeccion("antes-de-opciones") ?>
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
<?php $this->cerrarSeccion()?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'ajax' => true,
    'filtrosAjax' => [
        'nombre',
        'cupo_minimo',
        'fecha_inicio',
        'edad_maxima',
     ],
    
    'modelo' => 'Torneo',
    # id_torneo, cupo_maximo, cupo_minimo, edad_maxima, edad_minima, fecha_inicio, fecha_fin, nombre, observaciones, tabla_posiciones, equipo_id
    'columnas' => [
        'nombre',
        'cupo_minimo', 
        'edad_maxima',  
        'fecha_inicio',
    ],
    'opciones' => [
        ['i' => 'eye', 'url' => 'torneo/ver&{id:pk}', 'title' => 'Ver'],
        ['i' => 'pencil', 'url' => 'torneo/editar&{id:pk}', 'title' => 'Modificar'],
        ['i' => 'trash', 'url' => 'torneo/eliminar&{id:pk}', 'title' => 'Eliminar', 'opciones' => ['class' => 'op-eliminar']],
        ['i' => 'plus', 'url' => 'torneo/gestionarEquipos&{id:pk}', 'title' => 'Gestionar equipos'],
    ],
    'paginacion' => 10,
]) ?>