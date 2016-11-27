<?php 
    $this->tituloPagina = "Listar publicaciones";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Publicaciones'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Registrar' => ['Publicacion/crear'],
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
    'criterios' => [
        'order' => 'fn_comentarios_sin_aprobar(t.id_publicacion) > 0 DESC, id_publicacion DESC'
    ],
    # id_publicacion, titulo, contenido, consecutivo, fecha_publicacion, fecha_disponibilidad, tipo_id, lugar, hora, estado_id, usuario_id
    'columnas' => ['titulo', 
        'consecutivo',
        'estado_id' => 'EstadoPublic->nombre',
        'tipo_id' => 'TipoPublicacion->nombre',
        'comentarios' => ['valor' => 'ComentariosSinAprobar', 'opciones' => ['class' => 'text-center']], 
        'vistas',
        ],
    'opciones' => [
        ['i' => 'eye', 'url' => 'Publicacion/ver&{id:pk}', 'title' => 'Ver'],
        ['i' => 'pencil', 'url' => 'Publicacion/editar&{id:pk}', 'title' => 'Editar'],
        ['i' => 'globe', 'url' => 'Publicacion/visualizar&{id:pk}', 'title' => 'Ver en sitio web' , 'opciones' => ['target' => '_blank']],
    ],
    'paginacion' => 10,
]) ?>
