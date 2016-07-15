<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar TiposPublicacion'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Crear' => ['TipoPublicacion/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'TipoPublicacion',
    # id_tipo_publicacion, nombre, descripcion
    'columnas' => 'id_tipo_publicacion, nombre, descripcion',
    'opciones' => true,
    'paginacion' => 10,
]) ?>