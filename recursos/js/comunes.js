$(function(){
    aSelect2($("[data-s2]"));
    aDate($("[data-date]"));
});

function aDate(elementos, data){
    if(data === null || data === undefined){
        data = { dateFormat : 'yy-mm-dd' };
    }
    elementos.datepicker(data);
}

function aSelect2(elementos, data){
    if(data === null || data === undefined){
        data = { width: "100%" };
    }
    elementos.select2(data);
}
