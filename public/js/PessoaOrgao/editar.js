var orgao;
var tipoSituacao;
var tipoEspecieBeneficio;

$(document).ready(function () {
    
    $("#orgao").select2({placeholder: 'Selecione um Orgao Pagador'});
    $("#tipoSituacao").select2({placeholder: 'Selecione a Situação'});
    $("#tipoEspecieBeneficio").select2({placeholder: 'Selecione a Espécie'});
    
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


/* Preenchimento do SELECT2 */
window.onload = function () {
   setVariaveisGlobais();
   loadSelect2();
};

function setVariaveisGlobais() {
   orgao = $('#orgao').val();
   tipoSituacao = $('#tipoSituacao').val();
   tipoEspecieBeneficio = $('#tipoEspecieBeneficio').val();
}

function loadSelect2() {
   $("#orgao").select2("val", orgao);
   $("#tipoSituacao").select2("val", tipoSituacao);
   $("#tipoEspecieBeneficio").select2("val", tipoEspecieBeneficio);
}