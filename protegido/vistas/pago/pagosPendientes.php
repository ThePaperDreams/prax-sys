<?php 
$this->tituloPagina = "Pagos pendientes";
$this->migas = [
    'Home' => ['principal/inicio'],
    'Pagos pendientes',
];

$this->opciones = [
    'elementos' => [
        'Pagos realizados' => ['pago/realizados'],
    ]
];
 ?>

 <?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'ajax' => true,
    'exportar' => [
        'PDF' => ['url' => ['pago/reportePendientes'], 'nombre' => 'export-pdf', 'i' => 'file-pdf-o'],
    ],    
    'filtrosAjax' => [
    	'fecha_inicio' => CBoot::text('', ['name' => 'fecha_inicio', 'style' => 'max-width: 100%;', 'class' => 'campo-fecha']),
    	'fecha_fin' => CBoot::text('', ['name' => 'fecha_fin', 'style' => 'max-width: 100%;', 'class' => 'campo-fecha']),
        'matricula_id', 
        '_categoria',
    ],
    'modelo' => 'Pago',
    'criterios' => $criterios,
    'fnCriterios' => 'criteriosPendientes',
    # id_matricula, fecha_pago, url_comprobante, estado, deportista_id, categoria_id
    'columnas' => [
        'matricula_id' => 'MatriculaPago->Deportista->nombreCompleto',
        '_categoria' => 'categoria',
        'fecha_inicio',
        'fecha_fin',
    ],
    'opciones' => [
    	['i' => 'money', 'title' => 'Registrar pago', 'url' => 'pago/registrar&{id:pk}'],
    	['i' => 'check', 'title' => 'Condonar pago', 'url' => 'pago/condonar&{id:pk}'],
    ],
    'paginacion' => 10,
]) ?>