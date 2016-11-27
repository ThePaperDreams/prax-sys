<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar TiposPublicacion'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Registrar' => ['TipoPublicacion/crear'],
        ]
    ];
    $this->tituloPagina = "Listar tipos de publicación";
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'ajax' => true,
    'filtrosAjax' => [
        'nombre', 
     ],
    'modelo' => 'TipoPublicacion',
    # id_tipo_publicacion, nombre, descripcion
    'columnas' => ['nombre', 'descripcion' => 'resumen'],
    'opciones' => [
        ['i' => 'eye', 'title' => 'Ver','url' => 'TipoPublicacion/ver&{id:pk}', 'title' => 'Ver'],
        ['i' => 'pencil', 'title' => 'Editar', 'url' => 'TipoPublicacion/editar&{id:pk}','title' => 'Editar'],
        ['i' => 'trash', 'title' => 'Eliminar','url' => 'TipoPublicacion/eliminar&{id:pk}', 'title' => 'Eliminar', 'visible' => '$m->yaAsociado == false'],
    ],
    'paginacion' => 10,
]) ?>