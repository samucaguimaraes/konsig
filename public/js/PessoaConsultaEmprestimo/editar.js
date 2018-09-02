$(document).ready(function () {
    // Máscaras
    $(".dataContrato").mask("99/99/9999");
    
    $('.convenio').select2({placeholder: "Selecione..."});
    /*
    $('.valorParcela').maskMoney({
        showSymbol: true,
        symbol: 'R$ ', // Simbolo
        decimal: ',', // Separador do decimal
        precision: 2, // Precisão
        thousands: '.', // Separador para os milhares
        allowZero: true // Permite que o digito 0 seja o primeiro caractere
    }); 
    */
});