<?php

$this->tituloPagina = "Listar categorías de implementos";
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar categoría de implemento'
];

$this->opciones = [
    'elementos' => [
        'Crear' => ['Categoriaimplemento/crear'],
    ]
];
?>

<?=

$this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'CategoriaImplemento',
    'criterios' => ['order' => "estado=1 desc"],
    # id_categoria, nombre, descripcion
    'columnas' => ' nombre, descripcion,estado',
    'columnas' => [
        'nombre',
        'descripcion',
        'estado' => 'EtiquetaEstado',
    ],
    'opciones' => [
        ['i'=>'eye', 'title' => 'Ver','url'=>'Categoriaimplemento/ver&{id:pk}'],
        ['i'=>'pencil','title' => 'Editar','url'=>'Categoriaimplemento/editar&{id:pk}'],
        ['i'=>'refresh','title' => 'Cambiar estado','url'=>'Categoriaimplemento/anular&{id:pk}'],
    ],
    'paginacion' => 10,
])
?>