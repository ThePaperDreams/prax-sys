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
        <h4><?= $deportista->nombreCompleto ?></h4>
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
    <div class="row">        
        <div class="col-sm-6">
            <div class="page-header">
                <h5>Información de formación</h5>
            </div>
            <table class="table">
                <tr>
                    <th class="text-right">Dorsal:</th>
                    <td class="edit-cell" data-input-edit-cell="true" data-val="<?= $ficha->dorsal ?>">
                        <?= $ficha->dorsal ?>
                        <?= CBoot::text('', ['id' => 'dorsal', 'style' => 'display:none', 'class' => 'data-control-edit', 'data-type' => 'text']); ?>
                    </td>
                </tr>
                <tr>
                    <th class="text-right">Pierna hábil:</th>
                    <td class="edit-cell" data-input-edit-cell="true" data-val="<?= $ficha->pierna_habil ?>">
                        <?= $ficha->piernaStr ?>
                        <?php 
                        $pierna_habil = [
                            'Izquierda', 
                            'Derecha',
                            'Abmas'
                        ];                        
                        ?>
                        <?= CBoot::select('', $pierna_habil, ['id' => 'pierna-habil', 'style' => 'display:none', 'class' => 'data-control-edit', 'data-type' => 'select', 'defecto' => 'Seleccione una opción']) ?>
                    </td>
                </tr>
                <tr>
                    <th class="text-right">Valoración:</th>
                    <td><?= $ficha->valoracion ?></td>
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
                    <td><?= $ficha->leciones ?></td>
                </tr>
                <tr>
                    <th class="text-right">Talla:</th>
                    <td><?= $ficha->talla ?></td>
                </tr>
                <tr>
                    <th class="text-right">Peso:</th>
                    <td><?= $ficha->peso ?></td>
                </tr>
                <tr>
                    <th class="text-right">RH</th>
                    <td><?= $ficha->rh ?></td>
                </tr>
            </table>
        </div>
    </div>
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
        $("[data-input-edit-cell]").dblclick(function(){
            editCell($(this));
        });
    });
    
    function editCell(obj){
        var value = obj.attr("data-val");
        var control = obj.find(".data-control-edit");
        var type = control.attr("data-type");
        
        if(type === "text"){
            obj.html(control);
            control.val(value);
            control.slideDown().focus().select();            
            control.blur(function(e){
                guardarTxt(e, obj, control);
            });
        } else if(type === "select"){
            obj.html(control);
            control.val(value);
            control.slideDown();
            control.change(function(e, obj, control){
                guardarSelect(e, obj, control);
            });
        }
    }
    
    function guardarTxt(e, obj, control){
        var val = control.val();
        obj.html(val);
        control.unbind("blur keydown");
        control.css("display", "none");
        obj.append(control);
        obj.attr("data-val", val);
    }
</script>