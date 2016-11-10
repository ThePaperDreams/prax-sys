<?php
$this->ayuda = 'deportistas/inicio';
$this->ayudaTitulo = 'Listado de deportistas';

$this->tituloPagina = "Listar Deportistas";
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar Deportistas'
];

$this->opciones = [
    'elementos' => [
        'Registrar' => ['Deportista/crear'],
    ]
];
?>
<?php $this->abrirSeccion("antes-de-opciones"); ?>
<?php $this->cerrarSeccion(); ?>

<?=

$this->complemento('!siscoms.bootstrap3.CBGrid', [
    'ajax' => true,
    'exportar' => [
        'PDF' => ['url' => ['deportista/reporte'], 'i' => 'file-pdf-o'],
    ],
    'filtrosAjax' => [
        'doc' => CBoot::text('', ['name' => 'doc', 'style' => 'max-width: 150px;']),
        '_nombreCompleto' => CBoot::text('', ['name' => '_nombreCompleto', 'style' => 'max-width: 150px;']), 
        'edad' => CBoot::number('', ['name' => 'edad', 'style' => 'max-width: 100px;']),
        'fecha_nacimiento' => CBoot::text('', ['name' => 'fecha_nacimiento', 'style' => 'max-width: 100px;']),
        'estado_id' => CBoot::select('', $estados, ['defecto' => '---', 'style' => 'max-width: 100px;', 'name' => 'estado_id']),
        'matricula' => CBoot::select('', [1=>'Si', 2=>'No'], ['defecto' => '---', 'style' => 'max-width: 80px;', 'name' => 'matricula']),
     ],
    'criterios' => ['order' => 'estado_id=1 DESC, t.id_deportista DESC'],
    'modelo' => 'Deportista',
# id_deportista, identificacion, nombre1, nombre2, apellido1, apellido2, direccion, foto, telefono1, telefono2, fecha_nacimiento, estado_id, tipo_documento_id
     'columnas' => [
        'doc' => 'identificacion',
        '_nombreCompleto' => 'nombreCompleto',
        'edad',
        'fecha_nacimiento',
        'matricula' => ['valor' => 'matriculado', 'opciones' => ['class' => 'text-center']],
        'estado_id' => ['valor' => 'EtiquetaEstado', 'opciones' => ['class' => 'text-center']] 
    ],
    'opciones' => [
        ['i' => 'soccer-ball-o', 'url' => 'Deportista/fichaTecnica&{id:pk}', 'title' => 'Ficha técnica', 'visible' => '$m->estado_id != 4'],
        ['i' => 'eye', 'url' => 'Deportista/ver&{id:pk}', 'title' => 'Ver'],
        ['i' => 'pencil', 'url' => 'Deportista/editar&{id:pk}', 'title' => 'Editar'],
        ['i' => 'refresh', 'url' => 'Deportista/cambiarEstado&{id:pk}', 'title' => 'Cambiar estado'],
    ],
    'paginacion' => 10,
])
?>