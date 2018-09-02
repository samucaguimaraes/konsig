$(document).ready(function () {
    // Máscaras
    $("#numeroCPF").mask("999.999.999-99");    
    $("#numeroCPF").on("keyup", liberarSubmit);
  
});

function listConsultas(cpf) {
    mountDataTable('#listPessoaConsulta', 'PessoaConsulta', 'ListConsultasInContrato', 'numCPF=' + cpf);
}

function liberarSubmit() {

    var cpf = $(this).val();
    if (cpf.length === 14) { /* tamanho do CPF é igual a 14 */

        /* Cpf valido ? */
        var valideCPF = isCpf(cpf);

        /* Colaborador existe na base de dados ? */
        var isPessoaNotInSystem = AjaxPost({objeto: 'Pessoa', method: 'isPessoaNotInSystem', cpf: cpf});
        var obterDadosPessoa = AjaxPost({objeto: 'Pessoa', method: 'obterDadosPessoa', numeroCPF: cpf});
        
        /* CPF valido && colaborador participa do sistema  && Colaborador não tem ocupacao na sedes */
        //if (valideCPF === true && isColaboradorNotInSystem === true && isColaboradorSedes === true) {
        if (valideCPF === true && isPessoaNotInSystem === true) {
            //buttonEnabled("#salvar");
            listConsultas(cpf);
            $('#nomePessoa').empty();
            $('#nomePessoa').append(obterDadosPessoa['aaData'][0]);
            $('#cellTable').css("display","block");
        } else {
            $('#cellTable').css("display","none");
            $('#numeroCPF').popover('show');
        }
    } else { /* tamanho do CPF é diferente de 14 */
         $('#cellTable').css("display","none");
    }
}