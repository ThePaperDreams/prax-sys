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
        
        <h1><img id="img-logo" src="<?= Sis::UrlRecursos() ?>pics/logo-reportes.png"> Reporte de Implementos</h1>
        <table>
            <thead>
                <tr>
                    <th>Nombre categoría</th>
                    <th>Nombre Implemento</th>
                    <th>Unidades</th>
                    <th>Minimo unidades</th>
                    <th>Maximo unidades</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($implementos AS $implemento): ?>
                <tr>
                    <td><?= $implemento->Categoria->nombre ?></td>
                    <td class="text-center"> <?= $implemento->nombre ?></td>
                    <td class="text-center"> <?= ($implemento->unidades) ?></td>
                    <td class="text-center"> <?= ($implemento->minimo_unidades) ?></td>
                    <td class="text-center"> <?= ($implemento->maximo_unidades) ?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </body>
</html>
