$(document).ready(function() {
    // Máscaras
    $("#tipoNotificacao").select2({placeholder: 'Selecione...'});
    
    $("#tipoNotificacao").change(function() {
        if ($(this).val() != 1) {
            $("#dataAlarme").val("");
            $("#dataAlarme").attr("disabled", "disabled");
        } else {
            $("#dataAlarme").removeAttr("disabled");
        }
    });
    
});