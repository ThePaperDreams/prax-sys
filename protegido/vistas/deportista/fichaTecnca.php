<?php
$this->tituloPagina = "FT - $deportista->nombreCompleto";
$this->migas = [
    'Home' => ['principal/inicio'],
    'Listar Deportistas' => ['Deportista/inicio'],
    "Ficha técnica $deportista->nombreCompleto"
];
?>
<div class="tile p-15">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h4><?= $deportista->nombreCompleto ?></h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <?php if($deportista->foto != ""): ?>
            <img src="<?= Sis::UrlBase() ?>/publico/imagenes/deportistas/fotos/<?= $deportista->foto ?>">
            <?php else: ?>
            <img src="<?= Sis::UrlBase() ?>/publico/imagenes/deportistas/fotos/sin-foto.jpg">
            <?php endif ?>
        </div>
        <div class="col-sm-5">
            <table class="table">
                <tr>
                    <th class="text-right">Estado:</th>
                    <td><?= $deportista->etiquetaEstado ?></td>
                </tr>
                <tr>
                    <th class="text-right">Fecha de Nacimiento:</th>
                    <td><?= $deportista->fecha_nacimiento ?></td>
                </tr>
                <tr>
                    <th class="text-right">Edad:</th>
                    <td><?= $deportista->edad ?></td>
                </tr>
                <tr>
                    <th class="text-right">Documento:</th>
                    <td><?= $deportista->identificacion ?></td>
                </tr>
            </table>
        </div>
        <div class="col-sm-5">
            <table class="table">
                <tr>
                    <th class="text-right">Teléfono 1:</th>
                    <td><?= $deportista->telefono1 ?></td>
                </tr>
                <tr>
                    <th class="text-right">Teléfono 2:</th>
                    <td><?= $deportista->telefono2 ?></td>
                </tr>
                <tr>
                    <th class="text-right">Dirección:</th>
                    <td><?= $deportista->direccion ?></td>
                </tr>
                <tr>
                    <th class="text-right">&nbsp;</th>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div class="tile p-15">
    <div id="f-t-info">
        <div class="row">               
            <div class="col-sm-6">
                <div class="page-header">
                    <h5>Información de formación</h5>
                </div>
                <table class="table">
                    <tr>
                        <th class="text-right">Dorsal:</th>
                        <td id="s-dorsal" class="edit-cell" data-input-edit-cell="true">
                            <?= $ficha->dorsal ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-right">Pierna hábil:</th>
                        <td id="s-pierna" class="edit-cell" data-input-edit-cell="true">
                            <?= $ficha->piernaStr ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-right">Valoración:</th>
                        <td id="s-valor" ><?= $ficha->valoracion ?></td>
                    </tr>
                    <tr>
                        <th class="text-right">Faltas este mes:</th>
                        <td id="s-faltas"><?= $ficha->faltas ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-6">
                <div class="page-header">
                    <h5>Información de física</h5>
                </div>
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
        </div>
        <div class="row">
            <div class="col-sm-offset-4 col-sm-4 text-center">
                <?= CBoot::boton('Editar ' . CBoot::fa('pencil'), 'primary btn-block', ['id' => 'btn-editar']) ?>
            </div>
        </div>        
    </div>
    <!-- fin info -->
    <div id="f-t-form" style="display: none">
        <div class="row">               
            <div class="col-sm-6">
                <div class="page-header">
                    <input type="hidden" id="nuevo" value="<?= $ficha->nuevo? '1' : '0' ?>">
                    <input type="hidden" id="id-ficha" value="<?= $ficha->id_ficha_tecnica ?>">
                    <h5>Información de formación</h5>
                </div>
                <table class="table">
                    <tr>
                        <th class="text-right">Dorsal:</th>
                        <td class="edit-cell" data-input-edit-cell="true" data-val="<?= $ficha->dorsal ?>">
                            <?= CBoot::text($ficha->dorsal, ['id' => 'dorsal']) ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-right">Pierna hábil:</th>
                        <td class="edit-cell" data-input-edit-cell="true" data-val="<?= $ficha->pierna_habil ?>">
                            <?= CBoot::select($ficha->pierna_habil, $piernas, ['id' => 'pierna-habil']) ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-right">Valoración:</th>
                        <td>
                            <?= CBoot::number($ficha->valoracion, ['id' => 'valoracion']) ?>
                        </td>
                        
                    </tr>
                    <tr>
                        <th class="text-right">Faltas este mes:</th>
                        <td><?= $ficha->faltas ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-6">
                <div class="page-header">
                    <h5>Información de física</h5>
                </div>
                <table class="table">
                    <tr>
                        <th class="text-right">Lesiones</th>
                        <td>
                            <?= $ficha->leciones ?>
                            <?= CBoot::textArea($ficha->lesiones, ['id' => 'lesiones']) ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-right">Talla:</th>
                        <td>
                            <?= CBoot::number($ficha->talla, ['id' => 'talla']) ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-right">Peso:</th>
                        <td>
                            <?= CBoot::number($ficha->peso, ['id' => 'valoracion']) ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-right">RH</th>
                        <td>
                            <?= CBoot::select($ficha->rh, $gruposS, ['id' => 'rh']) ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-offset-4 col-sm-4 text-center">
                <?= CBoot::boton('Cancelar ', 'default', ['id' => 'btn-cancelar']) ?> 
                <?= CBoot::boton('Actualizar ' . CBoot::fa('pencil'), 'success', ['id' => 'btn-actualizar']) ?>
            </div>
        </div> 
    </div>
    <!-- fin form -->
</div>

<div class="tile p-15">
    <div class="page-header">
        <h5>Historial deportivo</h5>
    </div>
    <div class="row">        
        <div class="col-sm-6">
            <table class="table">
                <tr>
                    <th class="text-right">Amonestaciones:</th>
                    <td><?= $ficha->amonestacion ?></td>
                </tr>
                <tr>
                    <th class="text-right">Expulsiones:</th>
                    <td><?= $ficha->expulsion ?></td>
                </tr>
                <tr>
                    <th class="text-right">Partidos jugados: </th>
                    <td><?= $ficha->partidos ?></td>
                </tr>
                <tr>
                    <th class="text-right">Goles anotados:</th>
                    <td><?= $ficha->goles ?></td>
                </tr>
            </table>
        </div>
        <div class="col-sm-6">
            <table class="table">
                <tr>
                    <th class="text-right">Torneos jugados:</th>
                    <td><?= $ficha->torneos ?></td>
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
    </div>
</div>
<script>
    $(function(){
        $("#btn-editar").click(function(){
            $("#f-t-info").slideUp(function(){
                $("#f-t-form").slideDown();
            });        
        });
        
        $("#btn-cancelar").click(function(){
            $("#f-t-form").slideUp(function(){
                $("#f-t-info").slideDown();
            });        
        });
        
        $("#btn-actualizar").click(function(){
            guardarFicha();
        });
    });
    
    function guardarFicha(){
        var dorsal = $("#dorsal").val();
        var pierna = $("#pierna-habil").val();
        var valor = $("#valoracion").val();
        var lesion = $("#lesiones").val();
        var talla = $("#talla").val();
        var peso = $("#peso").val();
        var rh = $("#rh").val();
        var nuevo = $("#nuevo").val() === '1'? true : false;
        
        $.ajax({
            'type' : 'POST',
            'url' : '<?= Sis::crearUrl(['Deportista/fichaTecnica', 'id'=>$this->_g['id']]) ?>',
           data: {
               'ajx' : true,
               'ficha' : {
                   dorsal: dorsal,
                   pierna_habil: pierna,
                   valoracion: valor,
                   lesiones: lesion,
                   peso: peso,
                   rh: rh,                   
               },
               nuevo: nuevo,
           }, 
           success: function(obj){
               if(obj.error === false){
                   $("#s-dorsal").text(dorsal);
                   $("#s-pierna").text($("#pierna-habil option:selected").text());
                   $("#s-valor").text(valor);
                   $("#s-lesiones").text(lesion);
                   $("#s-talla").text(talla);
                   $("#s-peso").text(peso);
                   $("#s-rh").text(rh);
                   lobiAlert("success", "Se guardaron correctamente los datos");
               } else {
                   lobiAlert("error", "Ocurrió un error al guardar la ficha");
               }
           }
        });
        
        
    }
</script>