<?php
$this->tituloPagina = "Consultar pagos";
$this->migas = [
    'Home' => ['principal/inicio'],
    'Pagos pendientes',
];

$this->opciones = [
    'elementos' => [
        'Pagos pendientes' => ['pago/pagosPendientes'],
    ]
];
?>

<?=
$this->complemento('!siscoms.bootstrap3.CBGrid', [
    'ajax' => true,
    'exportar' => [
        'PDF' => ['i' => 'file-pdf-o', 'url' => ['pago/reporte']],
    ],
    'filtrosAjax' => [
        'fecha',
        'valor_cancelado', 
        'estado' => CBoot::select('', [1 => 'Activo', 0 => 'Anulado'], ['defecto' => 'Estado', 'style' => 'min-width: 150px;', 'name' => 'estado']),
        'descuento',
        'matricula_id',
        '_categoria'
     ],
    'modelo' => 'Pago',
    # id_plan_trabajo, descripcion, fecha_aplicacion, estado, categoria_id
    'columnas' => [
        'fecha',
        'valor_cancelado' => 'valorFormateado',
        'url_comprobante' => 'UrlDescarga',
        'estado' => 'EtiquetaEstado',
        'descuento',
        '_categoria' => 'categoria',
        'matricula_id' => 'MatriculaPago->Deportista->nombreCompleto',
    ],
    'opciones' => [
        ['i' => 'eye', 'title' => 'Ver', 'url' => 'pago/ver&{id:pk}'],
        ['i' => 'refresh', 'title' => 'Cambiar estado', 'url' => 'pago/anular&{id:pk}', 'visible' => '$m->estado == 1', 'opciones' => ['class' => 'op-eliminar', 'id' => 'cambioE']],
    ],
    'paginacion' => 10,
])
?>
<?php 

