$(document).ready(function() {
    $("#fecha-turno,#centro-medico" ).change(function() {
        var fecha = $("#fecha-turno").val();
        var idCentro = $("#centro-medico").val();
        var parametro = 'fecha='+ fecha + '& centro='+ idCentro;
        if(fecha!=null){
            $.ajax ({
            type: "GET",
            url: "hora.php",
            data: parametro,
            cache: false,
            success:
                function(html){
                    $("#horario").html(html);
            }
        });
    }}).trigger("change");
});