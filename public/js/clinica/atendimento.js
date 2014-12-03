

$(document).ready(function(){

    $('input#autenticar_medico').click(function(){

            $.ajax({
                dataType : 'json',
                type 	 : 'post',
                url:  '/clinica/atendimento/login-medico/',
                data     : {
                    user : $('input#user').val(),
                    senha :$('input#senha').val()
                },
                success : function(data){
                    if(data.status){                        
                        $(window.document.location).attr('href','/clinica/atendimento/atendimento/');
                    }
                    else{
                        alert('erro');
                        $('dt#submit-label').html(data.error)

                    }
                }
            });                
            
            
    });
    
});    