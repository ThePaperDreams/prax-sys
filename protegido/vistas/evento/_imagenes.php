<?php foreach($imagenes AS $imagen):  ?>
<div class="thumb-pic-gallery" data-id="<?= $imagen->id_imagen ?>" data-real-url="<?= Sis::UrlBase() ?>publico/imagenes/galerias/<?= $imagen->url ?>" data-thumb-url="<?= Sis::UrlBase() ?>publico/imagenes/galerias/thumbs/tmb_<?= $imagen->url ?>">
    <img class="pic-to-add" src="<?= Sis::UrlBase() ?>publico/imagenes/galerias/thumbs/tmb_<?= $imagen->url ?>">
</div>
<?php endforeach; ?>
<script>
    $(function(){
        $(".thumb-pic-gallery").click(function(){
            var cont = $(this);
            if(cont.hasClass("active")){
                cont.removeClass("active");
            } else {
                cont.addClass("active");
            }
        });
    });
</script>