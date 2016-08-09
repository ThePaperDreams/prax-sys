<?php 
    $this->tituloPagina = "Listar Documentos";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Documentos'
    ];
    
    /*$this->opciones = [
        'elementos' => [
            'Crear' => ['Documento/crear'],
        ]
    ];*/
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'Documento',
    # id_documento, url, titulo, tipo_id, papelera
    'columnas' => ['titulo','tipo_id' => 'TipoDocumento->nombre', 'url'],
    //'opciones' => true,
    'paginacion' => 10,
])
?>