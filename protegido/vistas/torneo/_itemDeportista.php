<li class="rep-jugador" id="deportista-<?= $deportista->id_deportista ?>" data-id="<?= $deportista->id_deportista ?>">
    <div class="deportista-equipo row">
        <div class="pic col-sm-3">
            <?php if($deportista->foto === "" || $deportista->foto === null): ?>
            <img src="<?= Sis::UrlBase() ?>/publico/imagenes/deportistas/fotos/sin-foto.jpg">
            <?php else: ?>
            <img src="<?= Sis::UrlBase()?>/publico/imagenes/deportistas/fotos/thumbs/tmb_<?= $deportista->foto ?>">
            <?php endif ?>
        </div>
        <div class="info col-sm-9">
            <table class="nombre table table-condensed" id="table-collapsed-<?= $deportista->id_deportista ?>" style="display:none">
                <tr>
                    <td>Nombre: </td><td><?= $deportista->nombreCompleto ?></td>
                    <td>Categoría: </td><td><?= $deportista->NombreCategoria ?> </td>
                    <td>Posición: </td><td><?= $deportista->Ficha->Pos ?></td>
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
                    <td><?= $deportista->NombreCategoria ?></td>
                </tr>
                <tr>
                    <td>Posición: </td>
                    <td>
                        <?= $deportista->Ficha->Pos ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</li>