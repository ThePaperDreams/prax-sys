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
            'Crear' => ['Categoria/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'Categoria',
    # id_categoria, nombre, descripcion, cupo_maximo, cupo_minimo, tarifa, edad_minima, edad_maxima, estado, entrenador_id
//    'columnas' => 'nombre, cupos, tarifaf, edad',
    'columnas' => [
        'nombre',
        'cupos' => ['valor' => 'cupos', 'opciones' => ['class' => 'text-center']],
        'tarifaf' => ['valor' => 'tarifaf', 'opciones' => ['class' => 'text-center']],
        'edad' => ['valor' => 'edad', 'opciones' => ['class' => 'text-center']],
        'estado' => ['valor' => 'EtiquetaEstado', 'opciones' => ['class' => 'text-center']],
    ],
    'opciones' => [
        ['i' => 'eye', 'url' => 'categoria/ver&{id:pk}', 'title' => 'Ver'],
        ['i' => 'pencil', 'url' => 'categoria/editar&{id:pk}', 'title' => 'Actualizar'],
        ['i' => 'remove', 'url' => 'categoria/cambiarEstado&{id:pk}', 'title' => 'Cambiar estado', 'visible' => '$m->estado == 1'],
        ['i' => 'trash', 'url' => 'categoria/eliminar&{id:pk}', 'title' => 'Eliminar categoría', 'visible' => '$m->enUso == false', 'opciones' => ['class' => 'op-eliminar']],
    ],
    'paginacion' => 10,
]) ?>