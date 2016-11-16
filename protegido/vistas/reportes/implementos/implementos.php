<?php
$this->migas = [
    'Home' => ['principal/inicio'],
    'Reportes' => ['reportes/todos'],
    'Implementos',
];

$this->opciones = [
    'elementos' => [
        'Todos los reportes' => ['reportes/todos'],
    ],
];

$this->tituloPagina = "Implementos del club";
 ?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'ajax' => true,
    'filtrosAjax' => [
        'categoria_id',
        'nombre', 
        'estado_id' => CBoot::select('', [1 => 'Activo', 2 => 'Inactivo'], ['defecto' => '---', 'style' => 'min-width: 100px;', 'name' => 'estado_id']),
        'unidades',
        'minimo_unidades',
        'maximo_unidades', 
     ],
    'exportar' => [
        'PDF' => ['i' => 'file-pdf-o', 'url' => ['implemento/reporte']],
    ],
    'modelo' => 'Implemento',
    'criterios' => ['order' => "estado_id=1 desc, nombre"],
    # id_implemento, categoria_id, nombre, descripcion, unidades, minimo_unidades, maximo_unidades
    'columnas' => [  
        "categoria_id"=>"Categoria->nombre",
        "nombre" => 'nombre',
        'estado_id' => 'EtiquetaEstado',
        "unidades",
        "minimo_unidades",
    ],
    'paginacion' => 10,
]) ?>