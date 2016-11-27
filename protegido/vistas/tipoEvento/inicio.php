<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar TiposEvento'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Crear' => ['TipoEvento/crear'],
        ]
    ];

    $this->tituloPagina = "Tipos de evento";
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'ajax' => true,
    'filtrosAjax' => [
        'nombre', 
     ],
    'modelo' => 'TipoEvento',
    # id_tipo, nombre, descripcion
    'columnas' => ['nombre', 'descripcion' => 'resumen'],
    'opciones' => [
        ['i' => 'eye', 'title' => 'Ver','url' => 'TipoEvento/ver&{id:pk}', 'title' => 'Ver'],
        ['i' => 'pencil', 'title' => 'Editar', 'url' => 'TipoEvento/editar&{id:pk}', 'title' => 'Editar'],
        ['i' => 'trash', 'title' => 'Eliminar','url' => 'TipoEvento/eliminar&{id:pk}', 'title' => 'Eliminar', 'visible' => '$m->yaAsociado == false', 'opciones' => ['class' => 'op-eliminar']],  
    ],
    'paginacion' => 10,
]) ?>
