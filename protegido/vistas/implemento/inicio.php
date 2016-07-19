<?php 
$this->tituloPagina="Implementos";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Implementos'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Crear' => ['Implemento/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'Implemento',
    # id_implemento, categoria_id, nombre, descripcion, unidades, minimo_unidades, maximo_unidades
    'columnas' => [
        "id_implemento",
        "categoria_id"=>"Categoria->nombre",
        "nombre",
        "descripcion",
        "unidades",
        "minimo_unidades",
        "maximo_unidades"
    ],
    'opciones' => true,
    'paginacion' => 10,
]) ?>