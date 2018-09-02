var cidade;
var estado;

$(document).ready(function () {
    // Máscaras
    $("#numeroCPF").mask("999.999.999-99");
    $("#dataNascimento").mask("99/99/9999");
    $("#numeroCEP").mask("99.999-999");
    
    $('#estado').select2({placeholder: "Selecione a cidade..."});
    $('#cidade').select2({placeholder: "Selecione um estado..."});
    $('#estado').on('change',select2TipoResposta);
});

function select2TipoResposta() {
    /* Pegar tipoQuesito selecionado */
    var estado = $(this).val();
    /* Configurar a requisição ajax*/
    var AjaxParams = {objeto: 'Cidade', method: 'ListSelect2Cidade', estado: estado};
    /* Configurar o retorno do objeto no html*/
    var fromObject = {
        id: '#cidade',
        object: $('div[id="s2id_cidade"] a:first'),
        msgEmpty: 'Selecione o estado.',
        msgSuccess: 'Selecione...',
        msgError: 'Nenhuma Cidade para esse estado.'
    };
    /* Exibir dados na tela com os options encontrados */
    ListSelect2Option(estado, fromObject, AjaxParams);
}

/* Preenchimento do SELECT2 */
window.onload = function () {
   setVariaveisGlobais();
   loadSelect2();
};

function setVariaveisGlobais() {
   cidade = $('#cidade').val();
   estado = $('#estado').val();
}

function loadSelect2() {
    $("#estado").select2("val", estado);
    $("#cidade").select2("val", cidade);   
}