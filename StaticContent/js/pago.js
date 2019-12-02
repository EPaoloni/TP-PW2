$(function () {

    $("#numero-tarjeta").on("input", function () {
        if (cardnumber($(this).val())) {
            $(this).addClass("border-success");
            $(this).removeClass("border-danger");
        } else {
            $(this).removeClass("border-success");
            $(this).addClass("border-danger");
        }
    });

    $("#fecha-caducidad").on("input", function () {
        if (validarFechaCaducidad($(this).val())) {
            $(this).addClass("border-success");
            $(this).removeClass("border-danger");
        } else {
            $(this).removeClass("border-success");
            $(this).addClass("border-danger");
        }
    });

});

function validarFechaCaducidad(fecha){
    var regexFecha = /^[0-1][0-9]\/[2][0-9]\b/
    if (fecha.match(regexFecha)) {
        return true;
    } else {
        return false;
    }
}

function cardnumber(inputtxt) {
    var cardno = /^(?:4[0-9]{12}(?:[0-9]{3})?)$/;
    if (inputtxt.match(cardno)) {
        return true;
    } else {
        return false;
    }
}