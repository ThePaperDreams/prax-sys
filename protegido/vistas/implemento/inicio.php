<?php 
$this->tituloPagina="Implementos";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Implementos'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Crear' => ['Implemento/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'ajax' => true,
    'filtrosAjax' => [
        'categoria_id',
        'nombre', 
        'estado_id' => CBoot::select('', [1 => 'Activo', 2 => 'Inactivo', 3 => 'En préstamo'], ['defecto' => 'Estado', 'style' => 'min-width: 150px;', 'name' => 'estado_id']),
        'unidades',
        'minimo_unidades',
        'maximo_unidades', 
     ],
    'modelo' => 'Implemento',
    'criterios' => ['order' => "estado_id=1 desc"],
    # id_implemento, categoria_id, nombre, descripcion, unidades, minimo_unidades, maximo_unidades
    'columnas' => [  
        "categoria_id"=>"Categoria->nombre",
        "nombre",
        'estado_id' => 'EtiquetaEstado',
        "unidades",
        "minimo_unidades",
        "maximo_unidades"
    ],
    'opciones' => [
        ['i' => 'eye', 'title' => 'Ver','url' => 'Implemento/ver&{id:pk}'],
        ['i' => 'pencil', 'title' => 'Editar', 'url' => 'Implemento/editar&{id:pk}', 'visible' => '$m->getEnPrestamo() == false'],
        ['i' => 'refresh', 'title' => 'Cambiar estado','url' => 'Implemento/anular&{id:pk}', 'visible' => '$m->getEnPrestamo() == false'],
    ],
    'paginacion' => 10,
]) ?>