<?php 
    $this->tituloPagina = "Listar Roles";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Roles'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Registrar' => ['Rol/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'Rol',
    # id_rol, nombre, descripcion, desarrollador
    'columnas' => 'nombre, descripcion',
    'opciones' => true,
    'paginacion' => 10,
]) ?>