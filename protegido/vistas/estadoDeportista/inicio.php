<?php 
    $this->tituloPagina = "Listar Estados de Deportistas";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Estados de Deportistas'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Registrar' => ['EstadoDeportista/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'EstadoDeportista',
    # id_estado, nombre, descripcion, icono, etiqueta
    'columnas' => 'nombre, descripcion',
    'opciones' => true,
    'paginacion' => 10,
])
?>