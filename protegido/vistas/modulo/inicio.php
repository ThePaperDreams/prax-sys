<?php 
    $this->tituloPagina = "Listar Módulos";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Modulos'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Registrar' => ['Modulo/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'Modulo',
    # id, nombre, descripcion
    'columnas' => 'nombre, descripcion',
    'opciones' => true,
    'paginacion' => 10,
]) ?>