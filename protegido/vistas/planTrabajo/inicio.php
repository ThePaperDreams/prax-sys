<?php 
    $this->tituloPagina = "Listar Planes de trabajo";
    $this->migas = [
        'Inicio' => ['principal/inicio'],
        'Listar Planes de trabajo'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Crear' => ['PlanTrabajo/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'PlanTrabajo',
    # id_plan_trabajo, descripcion, fecha_aplicacion, estado, categoria_id
    'columnas' => [
        'descripcion' => 'Resumen',
        'fecha_aplicacion',
        'estado' => 'EstadoEtiqueta',
        'total_objetivos' => 'TotalObjetivos',
    ],
    'opciones' => [
        ['i' => 'eye', 'url' => 'PlanTrabajo/ver&{id:pk}'],
        ['i' => 'pencil', 'url' => 'PlanTrabajo/editar&{id:pk}'],
        ['i' => 'trash', 'url' => 'PlanTrabajo/eliminar&{id:pk}', 'visible' => '$m->estado == 1', 'opciones' => ['class' => 'op-eliminar']],
    ],
    'paginacion' => 10,
]) ?>
<?php 
$script = '$(".op-eliminar").click(function(){'
            . 'return confirm("¿Seguro que desea realizar esta acción?");'
        . '});';
Sis::Recursos()->Script($script, CMRecursos::POS_READY);
?>