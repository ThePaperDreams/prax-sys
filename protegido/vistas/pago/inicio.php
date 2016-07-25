<?php 
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Pagos'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Crear' => ['Pago/registrar'],
        ]
    ];
?>

<?= $this->complemento('!siscoms.bootstrap3.CBGrid', [
    'modelo' => 'Pago',
    # id_pago, fecha, valor_cancelado, url_comprobante, estado, descuento, razon_descuento, matricula_id
    'columnas' => 'id_pago, fecha, valor_cancelado, url_comprobante',
    'opciones' => true,
    'paginacion' => 10,
]) ?>