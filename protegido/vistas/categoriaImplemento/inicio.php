<?php

$this->tituloPagina = "Listar categorías de implementos";
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar categoría de implemento'
];

$this->opciones = [
    'elementos' => [
        'Registrar' => ['Categoriaimplemento/crear'],
    ]
];
?>

<?=

$this->complemento('!siscoms.bootstrap3.CBGrid', [
    'ajax' => true,
    'filtrosAjax' => [
        'nombre', 
        'estado' => CBoot::select('', ['Inactivo','Activo'], ['defecto' => 'Estado', 'style' => 'min-width: 150px;', 'name' => 'estado']),

     ],
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
        ['i'=>'pencil','title' => 'Actualizar','url'=>'Categoriaimplemento/editar&{id:pk}'],
        ['i'=>'refresh','title' => 'Cambiar estado','url'=>'Categoriaimplemento/anular&{id:pk}'],
        ['i'=>'trash','title' => 'Eliminar','url'=>'Categoriaimplemento/eliminar&{id:pk}', 'visible' => '$m->getEnUso() == false', 'opciones' => ['class' => 'op-eliminar']],
    ],
    'paginacion' => 10,
])
?>