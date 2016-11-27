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
    'ajax' => true,
    'filtrosAjax' => [
        'nombre', 
        'estado' => CBoot::select("", [1 => 'Activo', 0 => 'Inactivo'], ['defecto' => 'Estado', 'style' => 'min-width: 150px;', 'name' => 'estado']),
        ],
    'criterios' => ['order'=>'estado=1 desc'],
    'modelo' => 'Rol',
    # id_rol, nombre, descripcion, desarrollador, estado
    'columnas' => ['nombre', 'estado' => 'etiquetaEstado'],
    'opciones' => [
        ['i' => 'eye', 'url' => 'Rol/ver&{id:pk}', 'title' => 'Ver'],
        ['i' => 'pencil', 'url' => 'Rol/editar&{id:pk}', 'title' => 'Editar'],
        ['i' => 'refresh', 'url' => 'Rol/cambiarEstado&{id:pk}', 'title' => 'Cambiar estado'],
    ],
    'paginacion' => 10,
]) ?>