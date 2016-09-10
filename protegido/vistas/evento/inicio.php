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
        'estado_id' => CBoot::select('', [1 => 'Disponible', 2 => 'No disponible', 3 => 'Borrador'], ['defecto' => 'Estado', 'style' => 'min-width: 150px;', 'name' => 'estado_id']),
        'fecha_publicacion',
        'tipo_id' => CBoot::select('', [1 => 'Noticia', 2 => 'Circular', 3 => 'Evento'], ['defecto' => 'Tipo de Publicación', 'style' => 'min-width: 150px;', 'name' => 'estado_id']),
        'autor',
     ],
    'modelo' => 'Evento',
    # id_evento, titulo, contenido, fecha_publicacion, fecha_disponibilidad, tipo_id, lugar, hora, estado
    'columnas' => ['titulo, fecha_publicacion',
        'autor'=>'Autor->nombres',
        'tipo'=>'TipoEvento->nombre',
        'estado'=>'Estado->nombre'],
    'opciones' => [
        ['i' => 'eye', 'url' => 'Evento/ver&{id:pk}'],
        ['i' => 'pencil', 'url' => 'Evento/editar&{id:pk}'],
    ],
    'paginacion' => 10,
]) ?>