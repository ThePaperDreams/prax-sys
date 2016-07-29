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
    'modelo' => 'Acudiente',
    # id_acudiente, identificacion, nombre1, nombre2, apellido1, apellido2, direccion, email, telefono1, telefono2, estado, tipo_doc_id
    'columnas' => [
        'identificacion',
        'nombre1',
        'apellido1',
        'telefono1',
        'estado' => 'EtiquetaEstado',
    ],
    'opciones' => [
        ['i' => 'eye', 'url' => 'Acudiente/ver&{id:pk}'],
        ['i' => 'pencil', 'url' => 'Acudiente/editar&{id:pk}'],
        ['i' => 'refresh', 'url' => 'Acudiente/cambiarEstado&{id:pk}'],
    ],
    'paginacion' => 10,
])
?>