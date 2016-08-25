<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Publicaciones'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Crear' => ['Publicacion/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'ajax' => true,
    'filtrosAjax' => [
        'titulo',
        'estado_id' => CBoot::select('', [1 => 'Borrador', 2 => 'Disponible', 3 => 'No disponible'], ['defecto' => 'Estado', 'style' => 'min-width: 150px;', 'name' => 'estado_id']),
        'tipo_id' => CBoot::select('', [1 => 'Noticia', 2 => 'Circular', 3 => 'Evento'], ['defecto' => 'Tipo de Publicación', 'style' => 'min-width: 150px;', 'name' => 'estado_id']),
     ],
    
    'modelo' => 'Publicacion',
    # id_publicacion, titulo, contenido, consecutivo, fecha_publicacion, fecha_disponibilidad, tipo_id, lugar, hora, estado_id, usuario_id
    'columnas' => ['titulo', 
        'consecutivo',
        'estado_id' => 'EstadoPublic->nombre',
        'tipo_id' => 'TipoPublicacion->nombre',
        ],
    'opciones' => [
        ['i' => 'eye', 'url' => 'Publicacion/ver&{id:pk}'],
        ['i' => 'pencil', 'url' => 'Publicacion/editar&{id:pk}'],
    ],
    'paginacion' => 10,
]) ?>