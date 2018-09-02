var idPessoaConsulta = getUrlParam('id');

$(document).ready(function () {
    /* DataTables */
    listEmprestimos();
    listEmprestimosNegociados();
    listContatos();
    //listOrgaos();
    //listConsultas();
    //updateListTarefas();

    //alert(idPessoa);
});

function listEmprestimos() {
    mountDataTable('#listPessoaConsultaEmprestimo', 'PessoaConsultaEmprestimo', 'ListEmprestimosInPessoaConsulta', 'idPessoaConsulta=' + idPessoaConsulta);
}

function listEmprestimosNegociados() {
    mountDataTable('#listPessoaConsultaEmprestimoNegociado', 'PessoaConsultaEmprestimo', 'ListEmprestimosNegociadosInPessoaConsulta', 'idPessoaConsulta=' + idPessoaConsulta);
}

function listContatos() {
    mountDataTable('#listPessoaContato', 'PessoaContato', 'ListContatosInPessoaConsulta', 'idPessoaConsulta=' + idPessoaConsulta);
}

function updateListTarefas() {
    //window.parent.listTarefas();
    //window.parent.refreshPagina();
}







