<?php
$this->tituloPagina = "Lista de espera";
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar Deportistas' => ['deportista/iniio'],
    'Lista de espera',
];

$this->opciones = [
    'elementos' => [
        'Registrar deportista' => ['Deportista/crear'],
        'Enviar a lista' => ['matricula/listaDeEspera'],
    ]
];
?>

<?=

$this->complemento('!siscoms.bootstrap3.CBGrid', [
    'ajax' => true,
    'filtrosAjax' => ['identificacion', '_nombreCompleto', 'apellido1'],
    'exportar' => [
        'PDF' => ['i' => 'file-pdf-o', 'url' => ['deportista/reporteListaEspera']]
    ],
    'modelo' => 'ListaEspera',
    'criterios' => [
        'where' => 'estado_id = 4',
    ],
# id_deportista, identificacion, nombre1, nombre2, apellido1, apellido2, direccion, foto, telefono1, telefono2, fecha_nacimiento, estado_id, tipo_documento_id
     'columnas' => [
        'identificacion',
        '_nombreCompleto' => 'nombreCompleto',
        'telefono1',
        'telefono2',
    ],
    'paginacion' => 10,
])
?>