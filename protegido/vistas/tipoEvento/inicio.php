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
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'TipoEvento',
    # id_tipo, nombre, descripcion
    'columnas' => 'nombre, descripcion',
    'opciones' => [
        ['i' => 'eye', 'title' => 'Ver','url' => 'TipoEvento/ver&{id:pk}'],
        ['i' => 'pencil', 'title' => 'Editar', 'url' => 'TipoEvento/editar&{id:pk}', 'visible' => '$m->getEnPrestamo() == false'],
        ['i' => 'refresh', 'title' => 'Cambiar estado','url' => 'TipoEvento/eliminar&{id:pk}', 'visible' => '$m->getEnPrestamo() == false'],
    ],
    'paginacion' => 10,
]) ?>