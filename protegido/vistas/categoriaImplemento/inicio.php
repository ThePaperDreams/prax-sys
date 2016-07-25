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
        ['i'=>'eye','url'=>'Categoriaimplemento/ver&{id:pk}'],
        ['i'=>'pencil','url'=>'Categoriaimplemento/editar&{id:pk}'],
        ['i'=>'refresh','url'=>'Categoriaimplemento/anular&{id:pk}'],
    ],
    'paginacion' => 10,
])
?>