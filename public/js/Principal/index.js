$(document).ready(function() {
    verificarAniversario();
    verificarNotificacao();
});

function verificarAniversario() {
    var totalAniversario = AjaxPost({objeto: 'Pessoa', method: 'IsPessoaAniversario'});

    if (totalAniversario) {
        $.Notify({
            caption: 'Comemore!',
            content: 'Existem clientes que fazem aniversário hoje. Dê os parabéns!',
            type: 'info',
            shadow: 'true',
            timeout: 7000,
            icon: "<span class='mif-gift mif-ani-shuttle'></span>"
        });
    }
}

function verificarNotificacao() {
    var totalNotificacao = AjaxPost({objeto: 'Notificacao', method: 'IsNotificacao'});

    if (totalNotificacao) {
        $.Notify({
            caption: 'Atenção!',
            content: 'Existem notificações de dados que devem ser verificadas.',
            type: 'warning',
            shadow: 'true',
            timeout: 7000,
            icon: "<span class='mif-bell mif-ani-ring'></span>"
        });
    }
}