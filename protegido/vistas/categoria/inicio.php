<?php 
    $this->ayuda = "categoria/inicio";
    $this->ayudaTitulo = "Listado de categorías";
    
    $this->tituloPagina = "Lista de categorías";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Categorias'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Registrar' => ['Categoria/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'Categoria',
    'criterios' => $criterios,
    'exportar' => [
        'PDF' => ['i' => 'file-pdf-o', 'url' => ['categoria/reporte']],
    ],
    'ajax' => true,
    'filtrosAjax' => [
        'nombre',
        'tarifa',
        'estado' => CBoot::select('', ['Inactivo', 'Activo'], ['defecto' => 'Estado', 'style' => 'min-width: 150px;', 'name' => 'estado']),
    ],
    # id_categoria, nombre, descripcion, cupo_maximo, cupo_minimo, tarifa, edad_minima, edad_maxima, estado, entrenador_id
    'columnas' => [
        'nombre',
        'cupos' => ['valor' => 'cuposDisponibles', 'opciones' => ['class' => 'text-center']],
        'matriculados',
        'tarifa' => ['valor' => 'tarifaf', 'opciones' => ['class' => 'text-center']],
        'edad' => ['valor' => 'edad', 'opciones' => ['class' => 'text-center']],
        'estado' => ['valor' => 'EtiquetaEstado', 'opciones' => ['class' => 'text-center']],
    ],
    'opciones' => [
        ['i' => 'eye', 'url' => 'categoria/ver&{id:pk}', 'title' => 'Ver'],
        ['i' => 'pencil', 'url' => 'categoria/editar&{id:pk}', 'title' => 'Actualizar'],
        ['i' => 'refresh', 'url' => 'categoria/cambiarEstado&{id:pk}', 'title' => 'Cambiar estado'],
        ['i' => 'trash', 'url' => 'categoria/eliminar&{id:pk}', 'title' => 'Eliminar categoría', 'visible' => '$m->enUso == false', 'opciones' => ['class' => 'op-eliminar']],
    ],
    'paginacion' => 10,
]) ?>