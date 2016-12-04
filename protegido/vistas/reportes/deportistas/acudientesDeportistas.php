<?php
$this->migas = [
    'Home' => ['principal/inicio'],
    'Reportes' => ['reportes/todos'],
    'Acudientes por deportistas',
];

$this->opciones = [
    'elementos' => [
        'Todos los reportes' => ['reportes/todos'],
    ],
];

$this->tituloPagina = "Deportistas por acudiente";
 ?>

<?=

$this->complemento('!siscoms.bootstrap3.CBGrid', [
    'ajax' => true,
    'exportar' => [
        'PDF' => ['url' => ['reportes/deportistasAcudientes'], 'i' => 'file-pdf-o'],
    ],
    'filtrosAjax' => [
        'identificacion' => CBoot::text('', ['name' => 'identificacion', 'style' => 'max-width: 150px;']),
        '_nombreCompleto' => CBoot::text('', ['name' => '_nombreCompleto', 'style' => 'max-width: 150px;']), 
        // '_acudientesString' => CBoot::text('', ['name' => '_acudientesString', 'style' => 'max-width: 150px;']),
     ],
    'fnCriterios' => 'filtroReporte',
    'criterios' => ['order' => 'estado	=1 DESC, t.id_acudiente DESC'],
    'modelo' => 'Acudiente',
# id_deportista, identificacion, nombre1, nombre2, apellido1, apellido2, direccion, foto, telefono1, telefono2, fecha_nacimiento, estado_id, tipo_documento_id
     'columnas' => [
        'identificacion' => ['valor' => 'identificacion', 'opciones' => ['style' => 'vertical-align: middle;']],
        '_nombreCompleto' => ['valor' =>'nombreCompleto', 'opciones' => ['style' => 'vertical-align: middle;']],
        '_deportistasString' => 'deportistasString', 
    ],
    'paginacion' => 10,
])
?>