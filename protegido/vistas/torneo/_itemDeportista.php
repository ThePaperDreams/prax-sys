<li class="rep-jugador" id="deportista-<?= $deportista->id_deportista ?>" data-id="<?= $deportista->id_deportista ?>">
    <div class="deportista-equipo row">
        <div class="pic col-sm-3">
            <img src="<?= Sis::UrlRecursos() ?>/pics/child.png">
        </div>
        <div class="info col-sm-9">
            <table class="nombre table table-condensed" id="table-collapsed-<?= $deportista->id_deportista ?>" style="display:none">
                <tr>
                    <td>Nombre: </td><td><?= $deportista->nombreCompleto ?></td>
                    <td>Categoría: </td><td>Pre pony </td>
                    <td>Posición: </td><td><span class="label label-success">Defensa</span> </td>
                </tr>
            </table>
            <table class="table-info table table-bordered table-condensed" id="table-expanded-<?= $deportista->id_deportista ?>">
                <tr>
                    <td>Nombre: </td>
                    <td><?= $deportista->nombreCompleto ?></td>
                </tr>
                <tr>
                    <td>Edad: </td>
                    <td><?= $deportista->edad ?></td>
                </tr>
                <tr>
                    <td>Categoría: </td>
                    <td><?= $deportista->nombreCompleto ?></td>
                </tr>
                <tr>
                    <td>Posición: </td>
                    <td><span class="label label-success">Defensa</span></td>
                </tr>
            </table>
        </div>
    </div>
</li>