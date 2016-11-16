<?php 

$this->tituloPagina = "Mapa de navegación de PRAX-SYS";

 ?>
<div class="tile p-15">

	<div class="row">
		<div class="col-sm-4">
			<h4>Opciones principales</h4>
			<ul class="nav-map">
				<?php foreach ($padres as $opcion): ?>

				<li data-id="<?= $opcion->id_opcion ?>" class="opcion-mapa" data-nivel="0">
					<i class="fa fa-<?=  $opcion->icono ?>"></i>
					<a href="#"><?= $opcion->nombre ?></a>
				</li>

				<?php endforeach ?>
			</ul>
		</div>

		<div class="col-sm-4">
			<h4>Sub-menú</h4>
			<ul class="nav-map" id="submenu">
				
			</ul>
		</div>

		<div class="col-sm-4">
			<h4>Acciones</h4>
			<ul class="nav-map" id="acciones">

			</ul>
		</div>		
		
	</div>
</div>
<script>
	$(function(){
		$(".opcion-mapa").click(function(){
			$(".opcion-mapa").removeClass("active");
			var opcion = $(this);
			opcion.addClass("active");
			consultarHijos(opcion.attr("data-nivel"), opcion.attr("data-id"));
		});
	});

	function agregarHijos(nivel, items){
		var padre;
		var sigNivel = 0;

		if(nivel == 0){
			padre = $("#submenu");
			$("#acciones").html("");
			sigNivel = 1;
		} else if(nivel == 1) {
			padre = $("#acciones");
			sigNivel = 2;
		}

		padre.fadeOut(function(){
			padre.html("");
			$.each(items, function(k,v){
				var el = $("<li/>", {'data-nivel' : sigNivel, 'data-id' : v.id, 'class' : 'second-level'});
				var link = $("<a/>", {'href' : '#'}).html(v.nombre);

				el.click(function(){
					$(".second-level").removeClass("active");
					el.addClass("active");
					consultarHijos(el.attr("data-nivel"), el.attr("data-id"));
				});

				el.append(link);
				padre.append(el);
			});
			padre.slideDown();
		});
	}

	function consultarHijos(nivel, id){
		$.ajax({
			'type' : 'POST',
			'url'  : '<?= Sis::crearUrl(['principal/mapaNavegacion']) ?>',
			'data' : {
				ajx_rq: true,
				id: id,
			}
		}).done(function(data){
			if(data.error == true){
				lobialert("error", "Ocurrió un error al consultar el mapa");
			} else if(data.error == false){

				agregarHijos(nivel, data.items);

			} else {
				lobialert("error", "Ocurrió un error inesperado");
			}
		});
	}

</script>