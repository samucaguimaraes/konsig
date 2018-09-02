$(document).ready(function() {
    // Máscaras

    $('#banco').select2({placeholder: "Selecione..."});
    $('#orgao').select2({placeholder: "Selecione..."});

    /* Mask */
    $('#valorTaxa').maskMoney({
        showSymbol: true,
        symbol: 'R$ ', // Simbolo
        decimal: ',', // Separador do decimal
        precision: 2, // Precisão
        thousands: '.', // Separador para os milhares
        allowZero: true // Permite que o digito 0 seja o primeiro caractere
    });

});