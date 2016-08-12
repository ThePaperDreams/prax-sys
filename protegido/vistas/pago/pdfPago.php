<style>
    body{
        font-family: arial;
        font-size: 14px;
    }
    table{
        width: 100%;
        border: 0px;
        border-collapse: collapse;
    }
    table tr td{
        border: 1px solid gray; 
        padding: 3px 10px;
    }
    table tr th{
        border: 1px solid gray; 
        padding: 3px 10px;
        background-color: #EEE;
    }
    .text-center{
        text-align: right;
    }
    h1{
        font-weight: 600;
        border-bottom: 1px solid gray;
        margin-bottom: 15px;
    }
    #img-logo{
        width: 60px;
        margin-right: 30px;
    }
</style>
<html>
    <body>
        
        <h1><img id="img-logo" src="<?= Sis::UrlRecursos() ?>pics/logo-reportes.png"> Reporte Pagos de Mensualidades</h1>
        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Valor cancelado</th>
                    <th>Descuento</th>
                    <th>Razón</th>
                    <th>Deportista</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($pagos AS $pago): ?>
                <tr>
                    <td><?= $pago->fecha ?></td>
                    <td class="text-center">$ <?= number_format($pago->valor_cancelado) ?></td>
                    <td class="text-center">$ <?= number_format($pago->descuento) ?></td>
                    <td><?= $pago->razon_descuento ?></td>
                    <td><?= $pago->MatriculaPago->Deportista->nombreDePila ?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </body>
</html>