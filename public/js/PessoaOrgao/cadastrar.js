$(document).ready(function () {
    // Máscaras
    $("#isCredencialPublica").click(function(id , val){
        if($(this).prop("checked")){
            $("#login").attr("data-validate-func", "required");
            $("#login").attr("data-validate-hint-position", "top");
            $("#login").attr("data-validate-hint", "Por Favor, preencha esse campo.");
            
            $("#senha").attr("data-validate-func", "required");
            $("#senha").attr("data-validate-hint-position", "top");
            $("#senha").attr("data-validate-hint", "Por Favor, preencha esse campo.");
            
        } else {
            $("#login").removeAttr("data-validate-func");
            $("#login").removeAttr("data-validate-hint-position");
            $("#login").removeAttr("data-validate-hint");
            
            $("#senha").removeAttr("data-validate-func");
            $("#senha").removeAttr("data-validate-hint-position");
            $("#senha").removeAttr("data-validate-hint");
        }
    });
});