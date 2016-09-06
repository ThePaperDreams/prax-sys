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
    'ajax' => true,
    'filtrosAjax' => [
        'fecha_realizacion', 
        'estado' => CBoot::select('', ['Anulado', 'Activo'], ['defecto' => 'Estado', 'style' => 'min-width: 150px;', 'name' => 'estado']),
        'responsable_id', 
     ],
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
        ["i"=>"eye", 'title' => 'Ver',"url"=>"Entrada/ver&{id:pk}"],
        ["i"=>"refresh", 'title' => 'Cambiar estado',"url"=>"Entrada/anular&{id:pk}", 'visible' => '$m->estado == 1']
    ],
    'paginacion' => 10,
]) ?>