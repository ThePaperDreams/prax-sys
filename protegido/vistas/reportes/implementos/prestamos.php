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

$this->tituloPagina = "Préstamos de implementos";

 ?>

 <?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'ajax' => true,
    'exportar' => [
        'PDF' => ['i' => 'file-pdf-o', 'url' => ['salida/reporte']],
    ],
    'filtrosAjax' => [
        'fecha_realizacion',
        'fecha_entrega', 
        'estado' => CBoot::select('', ['Inactivo', 'Activo', 'Devuelto'], ['defecto' => 'Estado', 'style' => 'min-width: 150px;', 'name' => 'estado']),
        'responsable_id', 
     ],
    'modelo' => 'Salida',
    'criterios' => [
        'order' => 'estado = 1 DESC'
    ],
    'columnas' => [
        "fecha_realizacion",
        "fecha_entrega",
        "descripcion",
        "responsable_id" =>"Usuario->nombres",
        'estado' => 'EtiquetaEstado',
    ],
    'paginacion' => 10,
]) ?>