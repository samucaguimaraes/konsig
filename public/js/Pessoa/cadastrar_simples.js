$(document).ready(function () {
    // Máscaras
    $("#numeroCPF").mask("999.999.999-99");
    $("#dataNascimento").mask("99/99/9999");
    $("#numeroCEP").mask("99.999-999");
    
    maskPhone("#numero");
    
    $('#estado').select2({placeholder: "Selecione..."});
    $('#cidade').select2({placeholder: "Selecione o estado."});
    $('#estado').on('change',select2TipoResposta);
    
        // Máscaras
    $("#isCredencialPublica").click(function(id , val){
        if($(this).prop("checked")){
            $("#login").attr("data-validate-func", "required");
            $("#login").attr("data-validate-hint-position", "top");
            $("#login").attr("data-validate-hint", "Por Favor, preencha esse campo.");
            
            $("#senha").attr("data-validate-func", "required");
            $("#senha").attr("data-validate-hint-position", "top");
            $("#senha").attr("data-validate-hint", "Por Favor, preencha esse campo.");
            
        } else {
            $("#login").removeAttr("data-validate-func");
            $("#login").removeAttr("data-validate-hint-position");
            $("#login").removeAttr("data-validate-hint");
            
            $("#senha").removeAttr("data-validate-func");
            $("#senha").removeAttr("data-validate-hint-position");
            $("#senha").removeAttr("data-validate-hint");
        }
    });
    
        
    
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