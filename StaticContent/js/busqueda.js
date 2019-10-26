$(function(){
    
    $("#destino").children("[value=" + $("#origen").val() + "]").prop("disabled", true);
    $("#destino").val(1);
    $("#origen").children("[value=1]").prop("disabled", true);

    $("#origen").on("change", function(){
        $("#destino").children("option").prop("disabled", false);
        $("#destino").children("[value=" + $(this).val() + "]").prop("disabled", true);
    });

    $("#destino").on("change", function(){
        $("#origen").children("option").prop("disabled", false);
        $("#origen").children("[value=" + $(this).val() + "]").prop("disabled", true);
    });


});

