<?php
$this->migas = [
    'Home' => ['principal/inicio'],
    'Reportes' => ['reportes/todos'],
    'Entradas de implementos',
];

$this->opciones = [
    'elementos' => [
        'Todos los reportes' => ['reportes/todos'],
    ],
];

$this->tituloPagina = "Entradas de implementos";
 ?>

 <?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'ajax' => true,
    'exportar' => [
        'PDF' => ['i' => 'file-pdf-o', 'url' => ['entrada/reporte']],
    ],
    'filtrosAjax' => [
        'fecha_realizacion', 
        'estado' => CBoot::select('', ['Anulado', 'Activo'], ['defecto' => 'Estado', 'style' => 'min-width: 150px;', 'name' => 'estado']),
        'responsable_id', 
     ],
    'modelo' => 'Entrada',
    'criterios' => [
        'order' => 'estado = 1 DESC'
    ],
    # id_entrada, fecha_realizacion, descripcion, responsable_id, estado
    'columnas' => [
        "fecha_realizacion",
        "descripcion",
        "responsable_id" =>"Usuario->nombres",
        "estado"=>'EtiquetaEstado',
    ],
    'paginacion' => 10,
]) ?>