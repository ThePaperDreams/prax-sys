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
        'estado_id' => CBoot::select('', $estd, ['defecto' => 'Estado', 'style' => 'min-width: 150px;', 'name' => 'estado_id']),
        'tipo_id' => CBoot::select('', $public, ['defecto' => 'Tipo de Publicación', 'style' => 'min-width: 150px;', 'name' => 'tipo_id']),
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
