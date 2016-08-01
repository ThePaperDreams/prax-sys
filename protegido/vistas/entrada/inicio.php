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
    'criterios' => [
        'order' => 'estado = 1 DESC'
    ],
    # id_entrada, fecha_realizacion, descripcion, responsable_id, estado
    'columnas' => [
        "fecha_realizacion",
        "descripcion",
        "responsable_id" =>"Usuario->nombres",
        "estado"=>'EtiquetaEstado',
    ],
    'opciones' => [
        ["i"=>"eye","url"=>"Entrada/ver&{id:pk}"],
        ["i"=>"refresh","url"=>"Entrada/anular&{id:pk}", 'visible' => '$m->estado == 1']
    ],
    'paginacion' => 10,
]) ?>