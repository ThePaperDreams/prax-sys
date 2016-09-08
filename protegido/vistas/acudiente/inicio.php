<?php 
    $this->tituloPagina = "Listar Acudientes";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Acudientes'
];

$this->opciones = [
        'elementos' => [
        'Registrar' => ['Acudiente/crear'],
    ]
];
?>

<?=

$this->complemento('!siscoms.bootstrap3.CBGrid', [
    'criterios' => ['order' => 'estado desc'],
    'ajax' => true,
    'filtrosAjax' => [
        'identificacion',
        'nombre1', 
        'telefono1', 
        'estado' => CBoot::select('', [1 => 'Activo', 0 => 'Inactivo'], ['defecto' => 'Estado', 'style' => 'min-width: 150px;', 'name' => 'estado'])        
     ],
    'modelo' => 'Acudiente',
    # id_acudiente, identificacion, nombre1, nombre2, apellido1, apellido2, direccion, email, telefono1, telefono2, estado, tipo_doc_id
    'columnas' => [
        'identificacion',
        'nombre1' => 'nombreCompleto',
        'telefono1',
        'estado' => 'EtiquetaEstado',
    ],
    'opciones' => [
        ['i' => 'eye', 'title' => 'Ver', 'url' => 'Acudiente/ver&{id:pk}'],
        ['i' => 'pencil', 'title' => 'Editar', 'url' => 'Acudiente/editar&{id:pk}'],
        ['i' => 'refresh', 'title' => 'Cambiar estado', 'url' => 'Acudiente/cambiarEstado&{id:pk}'],
    ],
    'paginacion' => 10,
])
?>