<?php 
    $this->tituloPagina = "Listar Roles";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Roles'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Registrar' => ['Rol/crear'],
            'Asignar permisos' => ['Permiso/asignar'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'Rol',
    # id_rol, nombre, descripcion, desarrollador, estado
    'columnas' => ['nombre', 'estado' => 'etiquetaEstado'],
    'opciones' => [
        ['i' => 'eye', 'url' => 'Rol/ver&{id:pk}'],
        ['i' => 'pencil', 'url' => 'Rol/editar&{id:pk}'],
        ['i' => 'refresh', 'url' => 'Rol/cambiarEstado&{id:pk}'],
    ],
    'paginacion' => 10,
]) ?>