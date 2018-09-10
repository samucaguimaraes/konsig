$(document).ready(function() {
    // Máscaras
    $("#dataContrato").mask("99/99/9999");
    $("#dataTipoSituacao").mask("99/99/9999");
    $("#dataCadastroContrato").mask("99/99/9999");

    $("#parceiro").select2({placeholder: 'Selecione...'});
    $("#corretor").select2({placeholder: 'Selecione...'});
    $("#corretorBanco").select2({placeholder: 'Selecione...'});
    $('#corretor').on('change',select2TipoResposta);
    
    $('#convenio').select2({placeholder: "Selecione..."});
    $('#pessoaOrgao').select2({placeholder: "Selecione..."});
    $('#pessoaOrgao').on('change', select2Convenio);

    $("#tipoSituacao").change(function() {
        if ($(this).val() == 1 || $(this).val() == 2) {
            $("#dataStatus").css("display", "block");
            $("#dataTipoSituacao").attr("data-validate-func", "required");
            $("#dataTipoSituacao").attr("data-validate-hint-position", "top");
            $("#dataTipoSituacao").attr("data-validate-hint", "Por Favor, preencha esse campo.");
        } else {
            $("#dataTipoSituacao").val("");
            $("#dataStatus").css("display", "none");
            $("#dataTipoSituacao").removeAttr("data-validate-func");
            $("#dataTipoSituacao").removeAttr("data-validate-hint-position");
            $("#dataTipoSituacao").removeAttr("data-validate-hint");
        }
    });

    $("#corretor").change(function() {
        if ($(this).val() != null) {
            $("#comissaoCorretor").attr("data-validate-func", "required");
            $("#comissaoCorretor").attr("data-validate-hint-position", "top");
            $("#comissaoCorretor").attr("data-validate-hint", "Por Favor, preencha esse campo.");
            $("#comissaoPagar").attr("class", "bg-grayLighter fg-red");
        } else {
            $("#comissaoPagar").attr("class", "ribbed-grayLight fg-white text-shadow");
            $("#comissaoCorretor").removeAttr("data-validate-func");
            $("#comissaoCorretor").removeAttr("data-validate-hint-position");
            $("#comissaoCorretor").removeAttr("data-validate-hint");
        }
    });

    $("#isComissao").click(function(id, val) {
        if ($(this).prop("checked")) {
            $("#comissaoContrato, #comissaoReceber, #comissaoPagar").attr("class", "ribbed-grayLight fg-white text-shadow");
            $("#comissao").attr("disabled", "disabled");
            $("#comissaoContrato, #comissaoReceber, #comissaoPagar").val("Não Comissionado");
            $("#comissao").removeAttr("data-validate-func");
            $("#comissao").removeAttr("data-validate-hint-position");
            $("#comissao").removeAttr("data-validate-hint");
        } else {
            $("#comissaoContrato").attr("class", "bg-grayLighter fg-emerald");
            $("#comissaoReceber").attr("class", "bg-grayLighter fg-cobalt");
            $("#comissaoPagar").attr("class", "bg-grayLighter fg-red");
            $("#comissaoContrato, #comissaoReceber, #comissaoPagar, #comissao, #comissaoCorretor").val("");
            //$("#comissaoReceber").val("");
            //$("#comissaoPagar").val("");
            $("#comissao").removeAttr("disabled");
            $("#comissao").attr("data-validate-func", "required");
            $("#comissao").attr("data-validate-hint-position", "top");
            $("#comissao").attr("data-validate-hint", "Por Favor, preencha esse campo.");
        }
    });

    /* Mask */
    $('#valorBruto,#valorLiquido,#valorParcela,#taxa,#comissao,#comissaoCorretor').maskMoney({
        showSymbol: true,
        symbol: 'R$ ', // Simbolo
        decimal: ',', // Separador do decimal
        precision: 2, // Precisão
        thousands: '.', // Separador para os milhares
        allowZero: true // Permite que o digito 0 seja o primeiro caractere
    });

    $("#tipoContrato").change(function() {
        if ($(this).val() == 1) { //Caso 1 - Contrato NOVO
            //$("#div_emprestimos").css("display", "none");
            //$('#cell_emprestimos').append("<span class='tag warning' style='margin:0px 0px 15px 0px;' id='message'>Contratos novos não requerem a seleção de empréstimos anteriores.</span>");
            $("#convenio").prop("disabled", false);
        } else {
            if ($(this).val() == 2) {// Caso 2 - Refinanciamento
                //if ($(".radioEmprestimo").is(":checked")) {
                //alert($("input:radio[name=emprestimo]:checked").val());
                $("#convenio").val($("#idConvenio").val()).change();
                //$("#convenio").prop( "disabled", true );
                //}
            } else {
                //$("#convenio").prop( "disabled", false );
            }
            //$("#div_emprestimos").css("display", "block");
            //$('#message').remove();
        }
        $('#valorBruto').val("");
        $('#valorLiquido').val("");
        $("#comissaoContrato").val("");
        $("#comissaoReceber").val("");
        $("#comissaoPagar").val("");
        if ($("#isComissao").prop("checked")) {
            $("#comissaoContrato").val("Não Comissionado");
            $("#comissaoReceber").val("Não Comissionado");
            $("#comissaoPagar").val("Não Comissionado");
        } else {
            $("#comissaoContrato").val("--");
            $("#comissaoReceber").val("--");
            $("#comissaoPagar").val("--");
        }
    });
    /*
     $("input:radio[name=emprestimo]").click(function(){
     if($("#tipoContrato").val() == 2){
     $("#convenio").val($("input:radio[name=emprestimo]:checked").val()).change();
     $("#convenio").prop( "disabled", true );
     }
     });
     */
    $(document).on('keyup', ".calculoComissao", function() {
        //$("#comissaoContrato").val(parseFloat($("#valorBruto").val()) * parseFloat($("#comissao").val()));
        //alert(parseFloat($('#valorBruto').val().replace(",", ".")));
        var valorBruto = $('#valorBruto').val().replace(".", "").replace(",", ".");
        var valorLiquido = $('#valorLiquido').val().replace(".", "").replace(",", ".");
        var valorComissao = $("#comissao").val().replace(",", ".");
        var valorComissaoCorretor = $("#comissaoCorretor").val().replace(",", ".");
        var valorComissaoContrato = 0;
        var valorComissaoReceber = 0;
        var valorComissaoPagar = 0;

        if ($("#tipoContrato").val() == 1) {//Caso 1 - NOVO
            var valorComissaoContrato = numeroParaMoeda(valorBruto * (valorComissao / 100));
            if ($("#comissaoCorretor").val() != "") {
                var valorComissaoPagar = numeroParaMoeda(valorBruto * (valorComissaoCorretor / 100));
                var valorComissaoReceber = numeroParaMoeda((valorBruto * (valorComissao / 100)) - (valorBruto * (valorComissaoCorretor / 100)));
            } else {
                var valorComissaoReceber = numeroParaMoeda((valorBruto * (valorComissao / 100)));
            }
            //alert(valorComissaoPagar);
        } else if ($("#tipoContrato").val() == 2) {//Caso 2 - REFINANCIAMENTO
            if ($("#tipoContratoOrigem").val() == 3) {//Caso Especial - REFINANCIAMENTO DE PORTABILIDADE
                var valorComissaoContrato = numeroParaMoeda(valorBruto * (valorComissao / 100));
                if ($("#comissaoCorretor").val() != "") {
                    var valorComissaoPagar = numeroParaMoeda(valorBruto * (valorComissaoCorretor / 100));
                    var valorComissaoReceber = numeroParaMoeda((valorBruto * (valorComissao / 100)) - (valorBruto * (valorComissaoCorretor / 100)));
                } else {
                    var valorComissaoReceber = numeroParaMoeda((valorBruto * (valorComissao / 100)));
                }
            } else {
                var valorComissaoContrato = numeroParaMoeda(valorLiquido * (valorComissao / 100));
                if ($("#comissaoCorretor").val() != "") {
                    var valorComissaoPagar = numeroParaMoeda(valorLiquido * (valorComissaoCorretor / 100));
                    var valorComissaoReceber = numeroParaMoeda((valorLiquido * (valorComissao / 100)) - (valorLiquido * (valorComissaoCorretor / 100)));
                } else {
                    var valorComissaoReceber = numeroParaMoeda((valorLiquido * (valorComissao / 100)));
                }
            }
        } else if ($("#tipoContrato").val() == 3) {//Caso 3 - PORTABILIDADE
            var valorComissaoContrato = numeroParaMoeda(valorBruto * (valorComissao / 100));
            if ($("#comissaoCorretor").val() != "") {
                var valorComissaoPagar = numeroParaMoeda(valorBruto * (valorComissaoCorretor / 100));
                var valorComissaoReceber = numeroParaMoeda((valorBruto * (valorComissao / 100)) - (valorBruto * (valorComissaoCorretor / 100)));
            } else {
                var valorComissaoReceber = numeroParaMoeda((valorBruto * (valorComissao / 100)));
            }
        }

        //var valorComissaoContrato = numeroParaMoeda(valorBruto * (valorComissao / 100));

        $("#comissaoContrato").val(valorComissaoContrato);
        $("#comissaoPagar").val(valorComissaoPagar);
        $("#comissaoReceber").val(valorComissaoReceber);
        //alert(valorBruto * valorComissao);
    });

});

function numeroParaMoeda(n, c, d, t)
{
    c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n < 0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}

function select2Convenio() {
    /* Pegar tipoQuesito selecionado */
    var pessoaOrgao = $(this).val();
    /* Configurar a requisição ajax*/
    var AjaxParams = {objeto: 'Convenio', method: 'ListSelect2Convenio', pessoaOrgao: pessoaOrgao};
    /* Configurar o retorno do objeto no html*/
    var fromObject = {
        id: '#convenio',
        object: $('div[id="s2id_convenio"] a:first'),
        msgEmpty: 'Selecione a matricula.',
        msgSuccess: 'Selecione...',
        msgError: 'Nenhum Convênio para o Orgão da Matricula.'
    };
    /* Exibir dados na tela com os options encontrados */
    ListSelect2Option(pessoaOrgao, fromObject, AjaxParams);
}

function select2TipoResposta() {
    /* Pegar tipoQuesito selecionado */
    var corretor = $(this).val();
    /* Configurar a requisição ajax*/
    var AjaxParams = {objeto: 'CorretorBanco', method: 'ListSelect2Banco', corretor: corretor};
    /* Configurar o retorno do objeto no html*/
    var fromObject = {
        id: '#corretorBanco',
        object: $('div[id="s2id_corretor"] a:first'),
        msgEmpty: 'Selecione o corretor.',
        msgSuccess: 'Selecione...',
        msgError: 'Nenhuma conta para esse corretor.'
    };
    /* Exibir dados na tela com os options encontrados */
    ListSelect2Option(corretor, fromObject, AjaxParams);
}