<?php 
    $this->tituloPagina = "Listar Documentos";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Documentos'
    ];
    
    /*$this->opciones = [
        'elementos' => [
            'Crear' => ['Documento/crear'],
        ]
    ];*/
?>
<div class="tile p-15">
    <div class="row">
        <div class="col-sm-6 p-10">
            <?php $boton = CBoot::boton('Buscar ' . CBoot::fa('search'), 'primary', ['id' => 'btn-buscar-doc']) ?>
            <?= CBoot::textAddOn('', ['id' => 'txt-buscar-doc', 'pos-btn' => $boton, 'placeholder' => 'Ingrese texto para buscar un documento']) ?>
        </div>
        <hr>
        <ul id="carpetas" class="carpetas">
            <?php foreach($categorias AS $cat): ?>
            <li class="carpeta carpeta-adentro" data-id="<?= $cat->id_tipo ?>">
                <i class="fa fa-folder"></i>
                <a href="#"><?= $cat->nombre ?></a>
            </li> 
            <?php endforeach; ?>
        </ul>
        
    </div>
</div>
<script>
    $(function(){
        $(".carpeta-adentro").click(function(){ abrirCarpeta($(this)); });
        $("#btn-buscar-doc").click(function(){ filtrar(); });
        $("#txt-buscar-doc").keyup(function(e){ if(e.which === 13){ filtrar(); } });
    });
    
    function filtrar(){
        var txt = $("#txt-buscar-doc");
        var textoBuscar = txt.val().toLowerCase();
        var documentos = $(".archivo");
        documentos.hide();
        if(textoBuscar === ""){
            documentos.show();
        } else {
            $("[data-nombre*='" + textoBuscar + "'].archivo").show();
            txt.focus().select();
        }
    }
    
    var carpetaActual = "raiz";
    var anterior = '';
    var breadcrumbs = [""];
    var enviar = true;
    
    function abrirCarpeta(obj, atras){
        if(enviar === false) { return; }
        if(enviar === true){ enviar = false; }
        if(atras){
            var t = breadcrumbs.length;
            breadcrumbs.splice(t - 1, 1);
            var id = breadcrumbs[t - 2];    
        } else {            
            var id = obj.attr("data-id");
            breadcrumbs.push(id);
        }
        $.ajax({
            'type' : 'POST',
            'url' : '<?= Sis::apl()->urlActual() ?>',
            'data' : {
                id: id,
                ajx:true,
            },
            'success' : function(obj){
                $("#carpetas").html(obj.items);
                $(".carpeta-adentro").click(function(){ abrirCarpeta($(this)); });
                $(".carpeta-atras").click(function(){ abrirCarpeta($(this), true); });
                enviar = true;
            }
        });
    }
    
</script>