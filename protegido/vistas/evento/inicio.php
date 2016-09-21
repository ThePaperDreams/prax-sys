<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Eventos'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Crear' => ['Evento/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'ajax' => true,
    'filtrosAjax' => [
        'titulo',
        'estado' => CBoot::select('', $Estado, ['defecto' => 'Estado', 'style' => 'min-width: 150px;', 'name' => 'estado']),
        'fecha_publicacion',
        'tipo_id' => CBoot::select('', $TipoEvento, ['defecto' => 'Tipo de Evento', 'style' => 'min-width: 150px;', 'name' => 'tipo_id']),
        'autor',
     ],
    
    'modelo' => 'Evento',
    'criterios' => [
        'order' => 'id_evento DESC',
    ],
    # id_evento, titulo, contenido, fecha_publicacion, fecha_disponibilidad, tipo_id, lugar, hora, estado
    'columnas' => [
        'titulo',
        'fecha_publicacion',
//        'autor'=>'Autor->nombres',
        'tipo_id'=>'TipoEvento->nombre',
        'estado'=>'Estado->nombre'
    ],
    'opciones' => [
        ['i' => 'eye', 'url' => 'Evento/ver&{id:pk}'],
        ['i' => 'pencil', 'url' => 'Evento/editar&{id:pk}'],
    ],
    'paginacion' => 10,
]) ?>
