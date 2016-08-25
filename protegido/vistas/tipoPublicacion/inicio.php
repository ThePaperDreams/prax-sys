<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar TiposPublicacion'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Crear' => ['TipoPublicacion/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'ajax' => true,
    'filtrosAjax' => [
        'nombre', 
     ],
    'modelo' => 'TipoPublicacion',
    # id_tipo_publicacion, nombre, descripcion
    'columnas' => ['nombre', 'descripcion'],
    'opciones' => [
        ['i' => 'eye', 'title' => 'Ver','url' => 'TipoPublicacion/ver&{id:pk}'],
        ['i' => 'pencil', 'title' => 'Editar', 'url' => 'TipoPublicacion/editar&{id:pk}',],
        ['i' => 'refresh', 'title' => 'Cambiar estado','url' => 'TipoPublicacion/eliminar&{id:pk}'],
    ],
    'paginacion' => 10,
]) ?>