
var select = document.getElementById('select-comp');
var despesas = document.getElementById('despesas');
var entradas = document.getElementById('entradas');
var total = document.getElementById('total');

(function ($){
    $("select").ready(function(){
        ajax();
    });

    $("select").change(function(){
        ajax();
    });


    function ajax(){
        str = select.value;
        $.get("../../../src/Controller/Competencias/Filtros/Filtro.php?id=" + str, function(data, status){
            var values = JSON.parse(data);

            entradas.value = parseFloat(values[0]).toLocaleString('pt-br', {minimumFractionDigits: 2});
            despesas.value = parseFloat(values[1]).toLocaleString('pt-br', {minimumFractionDigits: 2});
            total.value = parseFloat(values[2]).toLocaleString('pt-br', {minimumFractionDigits: 2});
        });
    }
})(jQuery);
