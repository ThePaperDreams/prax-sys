<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Salidas'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Crear' => ['Salida/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'Salida',
    # id_salida, cantidad, fecha_realizacion, fecha_entrega, descripcion, responsable_id, estado
    'columnas' => [
        "fecha_realizacion",
        "fecha_entrega",
        "descripcion",
        "responsable_id" =>"Usuario->nombres",
        "estado"
    ],
    'opciones' => [
        ["i"=>"eye","url"=>"Salida/ver&{id:pk}"]
    ],
    'paginacion' => 10,
]) ?>