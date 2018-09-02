$(document).ready(function () {
    $('#selectAll').click(function(event) {
        if(this.checked) {
            $('.checkboxM').each(function() {
                this.checked = true;               
            });
        }else{
            $('.checkboxM').each(function() {
                this.checked = false;        
            });         
        }
    });
    
    $("#tipoSituacao").select2({placeholder: 'Selecione...'});
});