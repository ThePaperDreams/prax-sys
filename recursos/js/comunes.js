var teclasEspeciales = [8, 16, 17, 18, 35, 36, 37, 38, 39, 40, 116];

$(function(){
    aSelect2($("[data-s2]"));
    aDate($(".campo-fecha, [data-date='1']"));
    soloNumeros($(".solo-numeros"));
    maximoNumero($(".maximo-numero"));
    $(".r-trim-zero").keyup(function(k){
        $(this).val(rtrimzero($(this).val()));
    });
    campoDoc($(".campo-doc"));
    aSelect2($("select.form-control:not([data-s2='1'])"));
    dontOverPass();
    overMiminum();
});

function dontOverPass(){
    $(".dont-overpass").each(function(k,v){
        var el = $(v);
        el.keyup(function(e){
            var max = el.attr("max") != undefined? el.attr("max") : 0;
            var ok = el.attr("data-ok") != undefined? parseInt(el.attr("data-ok")) : 0;
            var val = parseInt(el.val());
            if(el.val() == ''){ el.val(0); }
            if(val > max){
                el.val(ok);
            } else {
                ok = el.val();
            }
            el.attr("data-ok", ok);
            el.val(parseInt(el.val()));
        });
    });
}

function overMiminum(){
    $(".over-minimum").each(function(k,v){
        var el = $(v);
        el.keyup(function(e){
            var min = el.attr("min") != undefined? el.attr("min") : 0;
            var val = parseInt(el.val());
            console.log(val, min);
            if(val < min){
                el.val(min);
            }
        });
    });
}

function campoDoc(campos){
    campos.each(function(k,v){
        var e = $(v);
        e.keydown(function(evt){
            var str = e.val() + "";
            var total = str.length;
            if(evt.which != 8 && total == 15){
                evt.preventDefault();
                return false;
            }
        });
    });
}

function soloNumeros(elementos, data){
    
    elementos.each(function(k, v){
        var elemento = $(v);
        elemento.keydown(function(e){
            var c = String.fromCharCode(e.which);
            if(!esTeclaEspecial(e.which) && isNaN(c)){ e.preventDefault(); }
        });
    });
}

function rtrimzero(str){
    return parseInt(str);
}

function maximoNumero(elementos){
    elementos.each(function(k, v){
        var elemento = $(v);
        elemento.keyup(function(e){
            var max = parseInt(elemento.attr("max"));
            if(parseInt($(this).val()) > max){
                $(this).val(max);
            }
        });        
    });
}

function esTeclaEspecial(cod){
    for(var i = 0; i < teclasEspeciales.length; i ++){
        if(cod === teclasEspeciales[i]){ return true; }
    }
    return false;
}

function aDate(elementos, data){
    if(data === null || data === undefined){
        data = { dateFormat : 'yy-mm-dd' };
    } 

    elementos.datepicker({
        language: 'es',
        format: 'yyyy-mm-dd',   
    }).on('changeDate', function(e){
        var el = $(e.delegateTarget);
        el.change();

    });
}

function aSelect2(elementos, data){
    if(data === null || data === undefined){
        data = { width: "100%" };
    }
    elementos.select2(data);
}


$(function () {
  $('[data-toggle="popover"]').popover({
      placement: 'top',
      trigger: 'focus',
      html: true,
  });
});
