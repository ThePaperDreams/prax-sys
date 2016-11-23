<?php 
    $this->ayuda = 'documentos/inicio';
    $this->ayudaTitulo = "Documentos";

    $this->tituloPagina = "Listar Documentos";
    $this->migas = [
        'Home' => ['principal/inicio'],
        'Listar Documentos'
    ];
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

<div class="modal fade" id="modal-preview">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Previsualización: <span id="img-title"></span></h4>
            </div>
            <div class="modal-body">
                <img src="" alt="" id="preview-img">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <a href="#" id="preview-img-download" download class="btn btn-primary">Descargar <i class="fa fa-download"></i></a>
            </div>
        </div>
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
                $(".preview-doc").click(function(){
                    mostrarDoc($(this));
                    return false;
                });
                enviar = true;
            }
        });
    }

    function mostrarDoc(doc){
        $("#preview-img").attr("src", doc.attr("href"));
        var li = doc.closest("li");
        var title = li.attr("data-nombre");
        $("#img-title").html(title);
        $("#preview-img-download").attr("href", doc.attr("href")).attr("download", doc.attr("download"));
        $("#modal-preview").modal("show");
    }
    
</script>