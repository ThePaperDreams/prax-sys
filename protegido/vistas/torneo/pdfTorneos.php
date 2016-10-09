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
        
        <h1><img id="img-logo" src="<?= Sis::UrlRecursos() ?>pics/logo-reportes.png"> Torneos </h1>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Cupo Máximo</th>
                    <th>Cupo Mínimo</th>
                    <th>Edad Máxima</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Fin</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($torneos AS $torneo): ?>
                <tr>
                    <td><?= $torneo->nombre ?></td>
                    <td class="text-center">$ <?= $torneo->cupo_maximo ?></td>
                    <td class="text-center">$ <?= $torneo->cupo_minimo ?></td>
                    <td class="text-center">$ <?= $torneo->edad_maxima ?></td>
                    <td><?= $torneo->fecha_inicio ?></td>
                    <td><?= $torneo->fecha_fin ?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </body>
</html>