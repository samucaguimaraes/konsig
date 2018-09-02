var idPessoa = getUrlParam('id');

$(document).ready(function () {
    /* DataTables */
    listContatos();
    listOrgaos();
    listConsultas();
    listContratos();
    updateListTarefas();

    //alert(idPessoa);
});

function listContatos() {
    mountDataTable('#listPessoaContato', 'PessoaContato', 'ListContatosInPessoa', 'idPessoa=' + idPessoa);
}

function listOrgaos() {
    mountDataTable('#listPessoaOrgao', 'PessoaOrgao', 'ListOrgaosInPessoa', 'idPessoa=' + idPessoa);
}

function listConsultas() {
    mountDataTable('#listPessoaConsulta', 'PessoaConsulta', 'ListConsultasInPessoa', 'idPessoa=' + idPessoa);
}

function listContratos() {
    mountDataTable('#listPessoaContrato', 'PessoaContrato', 'ListContratosInPessoa', 'idPessoa=' + idPessoa);
}

function updateListTarefas() {
    //window.parent.listTarefas();
    //window.parent.refreshPagina();
}







