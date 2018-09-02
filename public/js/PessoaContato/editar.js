var tipoContato;
var operadora;

$(document).ready(function() {
    $("#tipoContato").select2({placeholder: 'Selecione o Tipo de Contato'});
    $("#operadora").select2({placeholder: 'Selecione a Operadora'});
});


/* Preenchimento do SELECT2 */
window.onload = function() {
    setVariaveisGlobais();
    loadSelect2();
};

function setVariaveisGlobais() {
    tipoContato = $('#tipoContato').val();
    operadora = $('#operadora').val();
}

function loadSelect2() {
    $("#tipoContato").select2("val", tipoContato);
    $("#operadora").select2("val", operadora);
}