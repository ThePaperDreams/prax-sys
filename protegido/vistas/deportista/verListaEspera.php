<?php
$this->tituloPagina = "Lista de espera";
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar Deportistas' => ['deportista/iniio'],
    'Lista de espera',
];

$this->opciones = [
    'elementos' => [
        'Ver Matrículas' => ['matricula/inicio'],
        'Registrar deportista' => ['Deportista/crear'],
        'Enviar a lista' => ['matricula/listaDeEspera'],
    ]
];
?>

<?=

$this->complemento('!siscoms.bootstrap3.CBGrid', [
    'ajax' => true,
    'filtrosAjax' => ['deportista_id', 'categoria_id', 'fecha_registro'],
    'exportar' => [
        'PDF' => ['i' => 'file-pdf-o', 'url' => ['deportista/reporteListaEspera']]
    ],
    'modelo' => 'ListaEspera',
    'columnas' => [
        'deportista_id' => 'Deportista->nombreIdentificacion',
        'categoria_id' => 'Categoria->nombre',
        'edad' => 'Deportista->edad',
        'fecha_registro',
        'estado' => 'etiquetaEstado',
    ],
    'opciones' => [
        ['i' => 'arrow-circle-right', 'url' => 'Matricula/matricular&{id:pk}{d:deportista_id}{c:categoria_id}', 'title' => 'Matricular', 'visible' => '$m->estado == 1'],
    ],
    'paginacion' => 10,
])
?>