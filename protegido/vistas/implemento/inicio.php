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
    'criterios' => ['order' => "estado_id=1 desc"],
    # id_implemento, categoria_id, nombre, descripcion, unidades, minimo_unidades, maximo_unidades
    'columnas' => [  
        "categoria_id"=>"Categoria->nombre",
        "nombre",
        'estado' => 'EtiquetaEstado',
        "unidades",
        "minimo_unidades",
        "maximo_unidades"
    ],
    'opciones' => [
        ['i' => 'eye', 'url' => 'Implemento/ver&{id:pk}'],
        ['i' => 'pencil', 'url' => 'Implemento/editar&{id:pk}'],
        ['i' => 'refresh', 'url' => 'Implemento/anular&{id:pk}'],
    ],
    'paginacion' => 10,
]) ?>