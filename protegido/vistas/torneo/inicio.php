<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Torneos'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Registrar' => ['Torneo/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'ajax' => true,
    'exportar' => [
        'pdf' => ['i' => 'file-pdf-o', 'url' => ['torneo/reporte']],
    ],
    'filtrosAjax' => [
        'nombre',
        'cupo_minimo',
        'fecha_inicio' => CBoot::text('', ['class' => 'campo-fecha j-grid-filtro form-control ', 'name' => 'fecha_inicio']),
        'fecha_fin' => CBoot::text('', ['class' => 'campo-fecha j-grid-filtro form-control ', 'name' => 'fecha_fin']),
        'edad_maxima',
     ],    
    'modelo' => 'Torneo',
    'criterios' => $criterios,
    'columnas' => [
        'nombre',
        'cupo_minimo', 
        'edad_maxima',  
        'fecha_inicio',
        'fecha_fin',
        'totalEquipos' => ['valor' => 'totalEquipos', 'opciones' => ['class' => 'text-center']],
    ],
    'opciones' => [
        ['i' => 'eye', 'url' => 'torneo/ver&{id:pk}', 'title' => 'Ver'],
        ['i' => 'pencil', 'url' => 'torneo/editar&{id:pk}', 'title' => 'Modificar'],
//        ['i' => 'trash', 'url' => 'torneo/eliminar&{id:pk}', 'title' => 'Eliminar', 'opciones' => ['class' => 'op-eliminar']],
        ['i' => 'plus', 'url' => 'torneo/gestionarEquipos&{id:pk}', 'title' => 'Gestionar equipos'],
    ],
    'paginacion' => 10,
]) ?>