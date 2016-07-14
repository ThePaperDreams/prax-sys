<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar PlanesTrabajo'
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
        'id_plan_trabajo', 
        'descripcion' => 'Resumen',
        'fecha_aplicacion',
        'estado' => 'EstadoEtiqueta',
        'total_objetivos' => 'TotalObjetivos',
    ],
    'opciones' => true,
    'paginacion' => 10,
]) ?>