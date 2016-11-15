<?php 
    $this->tituloPagina = "Listar Planes de trabajo";
    $this->migas = [
        'Inicio' => ['principal/inicio'],
        'Listar Planes de trabajo'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Registrar' => ['PlanTrabajo/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'ajax' => true,
    'filtrosAjax' => [
        'descripcion', 
        'fecha_aplicacion' => CBoot::text('',['name' => 'fecha_aplicacion', 'class' => 'campo-fecha']),
        'estado' => CBoot::select('', ['Eliminado', 'Activo'], ['defecto' => 'Estado', 'style' => 'min-width: 150px;', 'name' => 'estado']),
    ],
    'modelo' => 'PlanTrabajo',
    'criterios' => [
        'order' => 't.estado = 1 desc, t.id_plan_trabajo DESC',
    ],
    # id_plan_trabajo, descripcion, fecha_aplicacion, estado, categoria_id
    'columnas' => [
        'descripcion' => 'Resumen',
        'fecha_aplicacion',
        // 'estado' => ['valor' => 'EstadoEtiqueta', 'opciones' => ['class' => 'text-center']],
        'total_objetivos' => ['valor' => 'TotalObjetivos', 'opciones' => ['class' => 'text-center']],
    ],
    'opciones' => [
        ['i' => 'eye', 'title' => 'Ver', 'url' => 'PlanTrabajo/ver&{id:pk}'],
        ['i' => 'pencil', 'title' => 'Editar', 'url' => 'PlanTrabajo/editar&{id:pk}'],
        ['i' => 'trash', 'title' => 'Eliminar', 'url' => 'PlanTrabajo/eliminar&{id:pk}', 'visible' => '$m->estado == 1', 'opciones' => ['class' => 'op-eliminar']],
    ],
    'paginacion' => 10,
]) ?>