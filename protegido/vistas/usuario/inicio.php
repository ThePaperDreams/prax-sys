<?php 
    $this->tituloPagina = "Listar Usuarios";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Usuarios'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Registrar' => ['Usuario/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'Usuario',
    # id_usuario, rol_id, email, nombre_usuario, nombres, apellidos, telefono, clave, recuperacion, estado
    'columnas' => [
        'nombres',
        'apellidos',
        'email',
        'estado' => 'EtiquetaEstado',
    ],
    'opciones' => [
        ['i' => 'eye', 'url' => 'Usuario/ver&{id:pk}'],
        ['i' => 'pencil', 'url' => 'Usuario/editar&{id:pk}'],
        ['i' => 'refresh', 'url' => 'Usuario/cambiarEstado&{id:pk}'],
    ],
    'paginacion' => 10,
]) ?>