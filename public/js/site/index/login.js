

$(document).ready(function(){
    

    $('#logincl').submit(function(event){
        
        $('dd').find('p').each(function(){
             $(this).remove();
        });
        
        if( !ValidaEmail($('#email').val() ) ){
            $('#email-element').prepend('<p style="color:red;font-size:14px;">email inválido</p>');
            return false;
        }
        
        if( ($('#senha').val()).length < 6  ){
            $('#senha-element').prepend('<p style="color:red;font-size:14px;">a senha deve ter pelo menos 6 caracteres</p>');
            return false;
        }
        
        
       return true;
    });    
    
    
});