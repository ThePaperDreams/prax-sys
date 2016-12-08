<?php 
$this->tituloPagina = "Pagos Realizados";
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

 <?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'ajax' => true,
    'exportar' => [
        'PDF' => ['url' => ['pago/reporteRealizados'], 'nombre' => 'export-pdf', 'i' => 'file-pdf-o'],
    ],    
    'filtrosAjax' => [
    	'fecha_inicio' => CBoot::text('', ['name' => 'fecha_inicio', 'style' => 'max-width: 100%;', 'class' => 'campo-fecha']),
    	'fecha_fin' => CBoot::text('', ['name' => 'fecha_fin', 'style' => 'max-width: 100%;', 'class' => 'campo-fecha']),
        'matricula_id', 
        '_categoria',
    //     'categoria_id' => CBoot::select('', $categorias, ['defecto' => '---', 'style' => 'min-width: 150px;', 'name' => 'categoria_id', 'data-s22' => true]),
    ],
    'fnCriterios' => 'criteriosRealizados',
    'modelo' => 'Pago',
    'criterios' => $criterios,
    # id_matricula, fecha_pago, url_comprobante, estado, deportista_id, categoria_id
    'columnas' => [
        'matricula_id' => 'MatriculaPago->Deportista->nombreCompleto',
        '_categoria' => 'categoria',
        'fecha_inicio',
        'fecha_fin',
        'estado' => 'EtiquetaEstado',
    ],
    'opciones' => [
    	['i' => 'eye', 'title' => 'Registrar pago', 'url' => 'pago/ver&{id:pk}'],
        ['i' => 'ban', 'title' => 'Anular pago', 'url' => 'pago/anular&{id:pk}', 'visible' => '$m->estado == 1'],
    ],
    'paginacion' => 10,
]) ?>