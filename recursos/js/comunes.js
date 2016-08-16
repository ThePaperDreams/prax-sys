var teclasEspeciales = [8, 16, 17, 18, 35, 36, 37, 38, 39, 40, 116];

$(function(){
    aSelect2($("[data-s2]"));
    aDate($(".campo-fecha, [data-date='1']"));
    soloNumeros($(".solo-numeros"));
});

function soloNumeros(elementos, data){
    elementos.each(function(k, v){
        var elemento = $(v);
        elemento.keydown(function(e){
            var c = String.fromCharCode(e.which);
            if(!esTeclaEspecial(e.which) && isNaN(c)){ e.preventDefault(); }
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
    $.each(elementos, function(k, v){
        $(v).datepicker({
            language: 'es',
            dateFormat: 'yyyy-mm-dd',
            onSelect: function(fd, d, picker){
                $(v).change();
            }
        });
    });
}

function aSelect2(elementos, data){
    if(data === null || data === undefined){
        data = { width: "100%" };
    }
    elementos.select2(data);
}
