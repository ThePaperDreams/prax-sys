<?php
$this->migas = [
    'Home' => ['principal/inicio'],
    'Reportes' => ['reportes/todos'],
    'Pagos Realizados',
];

$this->opciones = [
    'elementos' => [
        'Todos los reportes' => ['reportes/todos'],
    ],
];

$this->tituloPagina = "Pagos Realizados";
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
    'paginacion' => 10,
])
?>