var TAlternativas;
var key_Alternativa;

$(document).ready(function () {
    // Máscaras
    $("#dataCompetencia").mask("99/9999");
    
    $("#addAlternativa,.deleteButton").click(function (event) {
        event.preventDefault();
    });   
    /*
    $('.ordem').sortable({
        forceHelperSize: true
    });
    $('.ordem').disableSelection();
    */
    
    data = new Date();
    mes = data.getMonth() < 10 ? "0" + (parseInt(data.getMonth())+1) : data.getMonth();
    $("#dataCompetencia").val(mes+ '/' +data.getFullYear());
    
    /* Mask */
    $('#vlrMargemDisponivel,#vlrMensalidadeReajustada,#vlrCompMr,#vlrSalarioFamilia,#vlrGratExcomb,#vlrRffsaNaoTrib,#vlrComplAcompan,#vlrOutrasVantagens,#vlrPlansferRffsa,#vlrDuplaAtividade,#vlrGratProdutEct,#vlrAdicTalidomida,#vlrIrRetidoFonte,#vlrDebPensaoAlim,#vlrConsignacao,#vlrIrExterior,#vlrDebitoDifIr,#vlrDescontoInss,#vlrTotalContribuicao').maskMoney({
        showSymbol: true,
        symbol: 'R$ ', // Simbolo
        decimal: ',', // Separador do decimal
        precision: 2, // Precisão
        thousands: '.', // Separador para os milhares
        allowZero: true // Permite que o digito 0 seja o primeiro caractere
    });    
});

function valor(id){
    
    var idInput = '#' + id;
    
    $(idInput).maskMoney({
        showSymbol: true,
        symbol: 'R$ ', // Simbolo
        decimal: ',', // Separador do decimal
        precision: 2, // Precisão
        thousands: '.', // Separador para os milhares
        allowZero: true // Permite que o digito 0 seja o primeiro caractere
    });
}

window.onload = function () {
    setVariaveisGlobais();
};

function setVariaveisGlobais() {
    //key_Alternativa = $(".tAlternativas").length;
    TAlternativas = key_Alternativa;
}

function adicionarAlternativa() {
    
    TAlternativas++;
    
    var idForm = 'div_Alternativa_' + key_Alternativa;
    
    if(TAlternativas === 1){
        $("#messageNoEmprestimo").empty();
    }
       
    //var input = '<label>Nome: <input type="text" name="foto[]" /> <a href="#" class="remove">X</a></label>';	
    $('#listEmprestimos').animate().append(htmlFormEmprestimos(idForm));    
    $('#totalEmprestimos').animate('slow').html('('+TAlternativas+')');
    key_Alternativa++;
}

function adicionarAlternativa1() {

    TAlternativas++;

    /* id do atributo */
    var idForm = '#div_Alternativa_' + key_Alternativa;
    /* obter html do form */
    var htmlImput = htmlFormAlternativas();
    /* adicionar o html em um espaço temporario */
    $('#tmp_html').html(htmlImput).show();
    /* limpar notice se existir */
    if (TAlternativas === 1) {
        $("#listAlternativas").html('');
    }
    /* clonar o html */
    $(idForm).clone().appendTo("#listAlternativas");
    /* eliminar o temp */
    $('#tmp_html').html('');
    /* Ir para div */
    $('html,body').animate({scrollTop: $(idForm).offset().top}, 'slow');
    /* add + 1 a key*/
    key_Alternativa++;
}

function deleteAlternativa(id) {
    if (confirm('Confirme para excluir o empréstimo?')) {

        TAlternativas--;
//        $(idTable).fadeOut('slow', function () {
//            $(idTable).remove();
//        });
        var idDiv = '#' + id;
        //$(idDiv).remove();
        //var but = $("a.deleteButton");
        $(idDiv).fadeOut('slow',function(){
            $(idDiv).remove();    
        });
        
        //but.closest("div.row");
        $('#totalEmprestimos').animate('slow').html('('+TAlternativas+')');
        if (TAlternativas === 0) {
            $('#totalEmprestimos').empty();
            $('#messageNoEmprestimo').append("<span class='tag warning'>Não existem empréstimos lançados nessa consulta.</span>");
        }
    }
}

function deleteAlternativa1(id) {
    if (confirm('Confirme para excluir a alternativa?')) {

        TAlternativas--;
        var idTable = '#' + id;
        $(idTable).fadeOut('slow', function () {
            $(idTable).remove();
        });
        if (TAlternativas === 0) {
            var notice = '';
            notice += '<div class="notice bg-amber" id="noticeAlternativas">';
            notice += '<div class="fg-white">';
            notice += '<h2>Não existe Alternativas.</h2>';
            notice += '</div>';
            notice += '</div>';
            notice += '<br />';
            $('#listAlternativas').html(notice).show();
        }
    }
}

function htmlFormEmprestimos(idForm) {
    
    var html = '';
    html += '<div class="row" id='+idForm+'>';
    html += '<div class="cell colspan2">';
    html += '<label>Valor R$ <b class="fg-red">*</b></label>';
    html += '<div class="input-control text full-size" data-role="input">';
    html += '<input type="text" name="alternativas[' + key_Alternativa + '][valor]" id="Altenativa_descricao_' + key_Alternativa + '" onfocus="valor(\'Altenativa_descricao_' + key_Alternativa + '\')" placeholder="Informe o valor R$" maxlength="100" autocomplete="off">';
    html += '<button class="button helper-button clear"><span class="mif-cross"></span></button>';
    html += '<span class="input-state-error mif-warning"></span>';
    html += '<span class="input-state-success mif-checkmark"></span>';
    html += '</div>';
    html += '</div>';
    html += '<div class="cell colspan10">';
    html += '<label>Observação</label>';
    html += '<div class="input-control text full-size" data-role="input">';
    html += '<input type="text" name="alternativas[' + key_Alternativa + '][observacao]" id="Altenativa_descricao_' + key_Alternativa + '" placeholder="Observações Adicionais" maxlength="100" autocomplete="off">';
    html += '<a onclick="deleteAlternativa(\'div_Alternativa_' + key_Alternativa + '\')" class="button deleteButton"><span class="mif-bin fg-red">Remover</span></a>';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    
    return html;
    
}


function htmlFormAlternativas() {

    var html = '';

    html += '<div class="grid fluid tAlternativas link" style="padding: 10px;background: #F0EEEE; border: 1px solid #E0DDDD;cursor: n-resize;" id="div_Alternativa_' + key_Alternativa + '">';

    html += '<div class="row">';

    html += '<div class="span11">';
    html += '<div class="input-control text" data-role="input-control">';
    html += '<input type="text" name="alternativas[][descricao]" id="Altenativa_descricao_' + key_Alternativa + '" required="" />';
    html += '<button class="btn-clear" tabindex="-1" type="button"></button>';
    html += '</div>';
    html += '</div>';

    html += '<div class="span1">';
    html += '<div class="toolbar transparent link place-right">';
    html += '<a onclick="deleteAlternativa(\'div_Alternativa_' + key_Alternativa + '\')" class="fg-red deleteButton" style="margin-top: 2px;cursor: pointer;"><i class="icon-cancel" style="padding: 10px;border-radius: 50%"></i></a>';
    html += '</div>';
    html += '</div>';

    html += '</div>';

    html += '</div>';

    return html;

}