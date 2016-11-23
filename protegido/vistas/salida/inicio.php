<?php 
$this->tituloPagina="Préstamo de implementos";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar salida de implementos'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Registrar' => ['Salida/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'ajax' => true,
    'exportar' => [
        'PDF' => ['i' => 'file-pdf-o', 'url' => ['salida/reporte']],
    ],
    'filtrosAjax' => [
        'fecha_realizacion',
        'fecha_entrega' => CBoot::text('', ['name' => 'fecha_entrega', 'class' => 'campo-fecha']), 
        'estado' => CBoot::select('', ['Inactivo', 'Activo', 'Devuelto'], ['defecto' => 'Estado', 'style' => 'min-width: 150px;', 'name' => 'estado']),
        'responsable_id', 
     ],
    'modelo' => 'Salida',
    'criterios' => [
        'order' => 'estado = 1 DESC'
    ],
    'columnas' => [
        "fecha_realizacion",
        "fecha_entrega" => 'fechaEntregaF',
        "resumen",
        "responsable_id" =>"Usuario->nombres",
        'estado' => 'EtiquetaEstado',
    ],
    'opciones' => [
        ["i"=>"eye", 'title' => 'Ver',"url"=>"Salida/ver&{id:pk}"],
        ['i' => 'exchange', 'title' => 'Devolver implemento','url' => 'Salida/entregar&{id:pk}', 'visible' => '$m->estado == 1'],
        ['i' => 'refresh', 'title' => 'Cambiar estado', 'url' => 'Salida/anular&{id:pk}', 'visible' => '$m->estado == 1'],
    ],
    'paginacion' => 10,
]) ?>