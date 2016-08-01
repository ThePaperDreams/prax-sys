<?php 
$this->tituloPagina="Salida de implementos";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar salida de implementos'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Crear' => ['Salida/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'Salida',
    'criterios' => [
        'order' => 'estado = 1 DESC'
    ],
    'columnas' => [
        "fecha_realizacion",
        "fecha_entrega",
        "descripcion",
        "responsable_id" =>"Usuario->nombres",
        'estado' => 'EtiquetaEstado',
    ],
    'opciones' => [
        ["i"=>"eye","url"=>"Salida/ver&{id:pk}"],
        ['i' => 'refresh', 'url' => 'Salida/anular&{id:pk}', 'visible' => '$m->estado == 1'],
    ],
    'paginacion' => 10,
]) ?>