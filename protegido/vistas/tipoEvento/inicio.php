<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar TiposEvento'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Crear' => ['TipoEvento/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'TipoEvento',
    # id_tipo, nombre, descripcion
    'columnas' => 'id_tipo, nombre, descripcion',
    'opciones' => true,
    'paginacion' => 10,
]) ?>