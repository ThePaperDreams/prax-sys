<?php 
$this->tituloPagina="Listar categorías de implementos";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar categoría de implemento'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Crear' => ['Categoriaimplemento/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'CategoriaImplemento',
    # id_categoria, nombre, descripcion
    'columnas' => ' nombre, descripcion',
    'opciones' => true,
    'paginacion' => 10,
]) ?>