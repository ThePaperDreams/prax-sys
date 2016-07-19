<?php 
$this->tituloPagina="Entrada de implementos";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Entradas'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Crear' => ['Entrada/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'Entrada',
    # id_entrada, fecha_realizacion, descripcion, responsable_id, estado
    'columnas' => [
        "fecha_realizacion",
        "descripcion",
        "responsable_id" =>"Usuario->nombres",
        "estado"
    ],
    'opciones' => [
        ["i"=>"eye","url"=>"Entrada/ver&{id:pk}"]
    ],
    'paginacion' => 10,
]) ?>