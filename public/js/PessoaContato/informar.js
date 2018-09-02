$(document).ready(function() {
    
});

function excluir($url) {
    if (confirm('Confirma a exclusão do contato do cliente?')) {
        redirectUrl($url);
    } else {
        event.preventDefault();
    }
}