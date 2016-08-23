/*
 * Pon en este documento todas las funciones que deben ser incluidas
 * en todoas las paginas
 */
(function($){
   jQuery.fn.justificarFalta = function(params){
       var callback = params.callback || function(){};
       var url = params.url || '';
       var data = params.data || {};
       var tr = $(this).closest("tr");
       var x = tr.offset().left;
       var y = tr.offset().top;
       
       var cortina = jQuery("<div/>",{class:'modal-courtain'}).css("display", "none");
       var panel = jQuery("<div/>", {class: 'panel panel-primary panel-faltas'}).css("display", "none");
       var heading = jQuery("<div/>", {class: 'panel-heading text-center'});
       var body = jQuery("<div/>", {class: 'panel-body'});
       var footer = jQuery("<div/>", {class: 'panel-footer text-center'});
       var textArea = jQuery("<textarea/>", {class: 'form-control', id: 'txt-justificar'});
       var btnGuardar = jQuery("<button/>", {class: 'btn btn-primary'}).text("Guardar");
       var btnCancelar = jQuery("<button/>", {class: 'btn btn-default'}).text("Cancelar");            
       
       var cerrar = function(){
           panel.slideUp(function(){
               cortina.fadeOut(function(){
                   cortina.remove();
               });
           });
       };       
       
       btnCancelar.click(function(){
           cerrar();
       });
       btnGuardar.click(function(){
           data.justificacion = textArea.val();
           jQuery.ajax({
               url: url,
               type: 'POST',
               data: data,
               success: function(r){
                   callback(r);
                   cerrar();
               },
           });
       });
       
       body.append(textArea);
       heading.text("Justificar falta");
       btnGuardar.css("margin-right", "10px");
       footer.append(btnGuardar, btnCancelar);
       panel.append(heading, body, footer);
       panel.css({
           width: "30%",
           position: "absolute",
           left: x + "px",
           top: y + "px"
       });
       cortina.append(panel);
       jQuery("body").append(cortina);
       cortina.fadeIn(function(){
           panel.slideDown(function(){
              textArea.focus(); 
           });
       });
   };
}(jQuery));
