<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar CategoriasImplementos'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Crear' => ['CategoriaImplemento/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'CategoriaImplemento',
    # id_categoria, nombre, descripcion
    'columnas' => 'id_categoria, nombre, descripcion',
    'opciones' => true,
    'paginacion' => 10,
]) ?>