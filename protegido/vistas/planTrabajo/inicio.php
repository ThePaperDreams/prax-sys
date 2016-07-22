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
    'opciones' => true,
    'paginacion' => 10,
]) ?>