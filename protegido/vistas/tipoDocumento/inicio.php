<?php 
    $this->tituloPagina = "Listar Tipos de Documentos";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Tipos de Documentos'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Registrar' => ['TipoDocumento/crear'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'TipoDocumento',
    # id_tipo, nombre, descripcion, padre_id
    'columnas' => ['nombre','padre_id' => 'TDocumento->nombre'],
    /*'columnas' => [
        'nombre',
        'padre_id' => 'TDocumento->nombre'
    ],*/
    'opciones' => true,
    'paginacion' => 10,
])
?>