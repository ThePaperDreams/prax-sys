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
    'ajax' => true,
    'filtrosAjax' => [
        'nombres',
        'apellidos', 
        'email', 
        'estado' => CBoot::select('', [1 => 'Activo', 0 => 'Inactivo'], ['defecto' => 'Estado', 'style' => 'min-width: 150px;', 'name' => 'estado'])        
     ],
    'criterios' => ['order' => 'estado=1 DESC'],
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