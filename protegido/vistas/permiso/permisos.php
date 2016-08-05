<?php 
    $this->tituloPagina = "Registrar Rol";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Roles' => ['Rol/inicio'],        
        'Asignar permisos'
    ];
    
    $this->opciones = [
        'elementos' => [
            'Listar' => ['Rol/inicio'],
        ]
    ];        
?>

<div class="tile p-15">
    <div class="row">        
        <div class="col-sm-6">
            <div class="form-group">
                <label class="control-label">Rol</label>
                <?= CBoot::select('', $roles, ['defecto' => 'Seleccione un rol', 'id' => 'combo-rol', 'data-type' => 'rol']) ?>
            </div>
            <div id="cont-mod" class="form-group" style="display:none">
                <label class="control-label">Módulo</label>
                <?= CBoot::select('', $modulos, ['defecto' => 'Seleccione un módulo', 'id' => 'combo-mod', 'data-type' => 'mod']) ?>
            </div>
        </div>    
        <div class="col-sm-6">        
            <table id="table-permisos" class="table table-bordered">
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(function(){
        
        $("#combo-mod, #combo-rol").change(function(){
            if($(this).attr("data-type") === "rol"){
                // me va a tocar anidar la condición para poder controlar la visibilidad
                // del combo de módulo
                if($(this).val() !== ""){
                    $("#cont-mod").slideDown();    
                } else {
                    $("#cont-mod").slideUp();
                }
                
            } else if($(this).attr("data-type") == "mod" && $(this).val() !== ""){
                doAjax( $("#combo-rol").val(), $(this).val());
            }
        });
    });
    function doAjax(id_rol, id_mod){
        $.ajax({
            'url' : '<?= Sis::CrearUrl(['permiso/asignar']) ?>',
            'type' : 'POST',
            'data' : {
                ajx:true,
                id_rol: id_rol,
                id_mod: id_mod
            }, 
            success: function(obj){
                if(obj.error === true){
                    // Muestra el error
                    console.log("Error al consultar los permisos");
                } else {
                    $("#table-permisos tbody").html(obj.html);
                }
            }
        });
    }
    
    function guardarPermiso(obj){
        var esNuevo = obj.attr("data-exist") != undefined? true : false;
        var checked = obj.prop("checked");
        var id = obj.attr("data-exist") != undefined? obj.attr("data-id") : 0;
        var ruta = obj.attr("data-id-ruta") != undefined? obj.attr("data-id-ruta") : 0;
        $.ajax({
            'url' : '<?= Sis::CrearUrl(['permiso/asignar']) ?>',
            'type' : 'POST',
            'data' : {
                ajx_save:true,
                esNuevo: esNuevo,
                id_rol: $("#combo-rol").val(),
                id: id,
                id_ruta: ruta,
                estado : checked === true? 1 : 0,
            }, 
            beforeSend: function(){
                obj.attr("disabled", "disabled"); // esto para impedir que se vuelva a dar clic sobre el checkbox y se ejecute otro ajax sin que acabe el primero
            },
            success: function(res){
                if(res.error === false){
                    // Muestra el error
                    console.log("Se guardó correctamente el permiso");
                    obj.attr("data-exist", "1");
                    obj.attr("data-id", res.id);
                } else {
                    console.log("Error al guarda el permiso");
                }
                obj.removeAttr("disabled");
            }
        });
    }
</script>