$(document).ready(function () {
    /* DataTables */
    listAniversario();
    listEmprestimoDisponivel();
    listMargemDisponivel();
    //alert(idPessoa);
});

function listAniversario() {
    mountDataTable('#listAniversario', 'Pessoa', 'ListAniversario');
}

function listEmprestimoDisponivel() {
    mountDataTable('#listEmprestimosDisponiveis', 'PessoaConsultaEmprestimo', 'ListEmprestimosDisponiveisInGestao');
}

function listMargemDisponivel() {
    mountDataTable('#listMargensDisponiveis', 'PessoaConsulta', 'ListMargensDisponiveisInGestao');
}

function metroDialog(id) {
    $.Dialog({
        title: "Dialog title",
        content: "This is a dialog content"
    });
}