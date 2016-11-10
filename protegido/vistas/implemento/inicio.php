<?php 
$this->tituloPagina="Implementos";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Implementos'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Registrar' => ['Implemento/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'ajax' => true,
    'filtrosAjax' => [
        'categoria_id',
        'nombre', 
        'estado_id' => CBoot::select('', [1 => 'Activo', 2 => 'Inactivo'], ['defecto' => '---', 'style' => 'min-width: 100px;', 'name' => 'estado_id']),
        'unidades',
        'minimo_unidades',
        'maximo_unidades', 
     ],
    'exportar' => [
        'PDF' => ['i' => 'file-pdf-o', 'url' => ['implemento/reporte']],
    ],
    'modelo' => 'Implemento',
    'criterios' => ['order' => "estado_id=1 desc, nombre"],
    # id_implemento, categoria_id, nombre, descripcion, unidades, minimo_unidades, maximo_unidades
    'columnas' => [  
        "categoria_id"=>"Categoria->nombre",
        "nombre" => 'NombreEstado',
        'estado_id' => 'EtiquetaEstado',
        "unidades",
        "minimo_unidades",
    ],
    'opciones' => [
        ['i' => 'eye', 'title' => 'Ver','url' => 'Implemento/ver&{id:pk}'],
        ['i' => 'pencil', 'title' => 'Actualizar', 'url' => 'Implemento/editar&{id:pk}', 'visible' => '$m->getEnPrestamo() == false'],
        ['i' => 'refresh', 'title' => 'Cambiar estado','url' => 'Implemento/anular&{id:pk}', 'visible' => '$m->getEnPrestamo() == false'],
    ],
    'paginacion' => 10,
]) ?>