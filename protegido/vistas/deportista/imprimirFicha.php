<table class="table-simple">
    <thead>
        <tr>
            <td class="col-2">
                <?php if($deportista->foto != ""): ?>
                <img class="img-res" style="width: 100px" src="<?= Sis::UrlBase() ?>/publico/imagenes/deportistas/fotos/<?= $deportista->foto ?>">
                <?php else: ?>
                <img class="img-res" style="width: 100px" src="<?= Sis::UrlBase() ?>/publico/imagenes/deportistas/fotos/sin-foto.png">
                <?php endif ?>
            </td>
            <td class="col-7">
                <table class="">
                    <tr>
                        <th class="text-left">Estado:</th>
                        <td><?= $deportista->etiquetaEstado ?></td>
                        <th class="text-left">Teléfono 1:</th>
                        <td><?= $deportista->telefono1 ?></td>
                    </tr>
                    <tr>
                        <th class="text-left">Fecha de Nacimiento:</th>
                        <td><?= $deportista->fecha_nacimiento ?></td>
                        <th class="text-left">Teléfono 2:</th>
                        <td><?= $deportista->telefono2 ?></td>
                    </tr>
                    <tr>
                        <th class="text-left">Edad:</th>
                        <td><?= $deportista->edad ?></td>
                        <th class="text-left">Dirección:</th>
                        <td><?= $deportista->direccion ?></td>
                    </tr>
                    <tr>
                        <th class="text-left">Documento:</th>
                        <td><?= $deportista->identificacion ?></td>
                        <th class="text-left">&nbsp;</th>
                        <td>&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </thead>    
</table>
<br><br>
<h3>Información de la formación</h3>
<hr>
<div class="col-5">    
    <table class="table">
        <tr>
            <th class="text-left">Dorsal:</th>
            <td id="s-dorsal" class="edit-cell" data-input-edit-cell="true">
                <?= $ficha->dorsal ?>
            </td>
        </tr>
        <tr>
            <th class="text-left">Pierna hábil:</th>
            <td id="s-pierna" class="edit-cell" data-input-edit-cell="true">
                <?= $ficha->piernaStr ?>
            </td>
        </tr>
        <tr>
            <th class="text-left">Valoración:</th>
            <td id="s-valor" ><?= $ficha->valoracion ?></td>
        </tr>
        <tr>
            <th class="text-left">Faltas este mes:</th>
            <td id="s-faltas"><?= $ficha->faltas ?></td>
        </tr>
    </table>
</div>
<div class="col-5">
    <table class="table">
        <tr>
            <th class="text-right">Lesiones</th>
            <td id="s-lesiones"><?= $ficha->lesiones ?></td>
        </tr>
        <tr>
            <th class="text-right">Talla:</th>
            <td id="s-talla"><?= $ficha->talla ?></td>
        </tr>
        <tr>
            <th class="text-right">Peso:</th>
            <td id="s-peso"><?= $ficha->peso ?></td>
        </tr>
        <tr>
            <th class="text-right">RH</th>
            <td id="s-rh"><?= $ficha->rh ?></td>
        </tr>
    </table>
</div>
<br><br>
<h3>Historial deportivo</h3>
<hr>
<div class="col-5">
    <table class="table">
        <tr>
            <th class="text-right">Amonestaciones:</th>
            <td><?= $ficha->amonestaciones ?></td>
        </tr>
        <tr>
            <th class="text-right">Expulsiones:</th>
            <td><?= $ficha->expulsiones ?></td>
        </tr>
        <!-- <tr>
            <th class="text-right">Partidos jugados: </th>
            <td><?= $ficha->partidos ?></td>
        </tr> -->
        <tr>
            <th class="text-right">Torneos jugados:</th>
            <td><?= $ficha->torneos ?></td>
        </tr>
        <tr>
            <th class="text-right">Goles anotados:</th>
            <td><?= $ficha->anotaciones ?></td>
        </tr>
    </table>
</div>
<div class="col-5">
    <table class="table">
        <!-- <tr>
            <th class="text-right">Torneos jugados:</th>
            <td><?= $ficha->torneos ?></td>
        </tr> -->
        <tr>
            <th class="text-right">&nbsp;</th>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th class="text-right">&nbsp;</th>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th class="text-right">&nbsp;</th>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th class="text-right">&nbsp;</th>
            <td>&nbsp;</td>
        </tr>
    </table>
</div>