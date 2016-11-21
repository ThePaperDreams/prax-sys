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
        'identificacion',
        '_nombreCompleto', 
        '_edad' => CBoot::number('', ['name' => '_edad', 'style' => 'max-width: 100px;', 'maxlength' => 2, 'min' => 0, 'max' => 99, 'class' => 'solo-numeros maximo-numero r-trim-zero']),
        'fecha_nacimiento' => CBoot::text('', ['name' => 'fecha_nacimiento', 'style' => 'max-width: 100px;', 'class' => 'campo-fecha']),
        'estado_id' => CBoot::select('', $estados, ['defecto' => '---', 'style' => 'max-width: 100px;', 'name' => 'estado_id']),
        'matricula' => CBoot::select('', [1=>'Si', 2=>'No'], ['defecto' => '---', 'style' => 'max-width: 80px;', 'name' => 'matricula']),
     ],
    'criterios' => ['order' => 'estado_id=1 DESC, t.id_deportista DESC'],
    'modelo' => 'Deportista',
# id_deportista, identificacion, nombre1, nombre2, apellido1, apellido2, direccion, foto, telefono1, telefono2, fecha_nacimiento, estado_id, tipo_documento_id
     'columnas' => [
        'identificacion' => 'identificacion',
        '_nombreCompleto' => 'nombreCompleto',
        '_edad' => 'edad',
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