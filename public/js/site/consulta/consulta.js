    
$(document).ready(function(){
    
    $('.bt-consulta #fazer_login').click(function(){       
        $( "#dialog" ).dialog({           
            height:500,
            width:580,
            modal: true,
            resizable: false,
        });
    });
    
    $('#close').click(function(){
         $( "#dialog" ).dialog( "close" );
    });
    
    
    $('#login').click(function(){
                
            $.ajax({
                dataType : 'json',
                type 	 : 'post',
                url:  $("#loginx").attr('action'),
                data     : {
                    email : $('input#email').val(),
                    senha :$('input#senha').val()
                },
                success : function(data){
                    if(data.status){                                                
                        $(window.document.location).attr('href',document.URL);
                    }
                    else{
                        $('dt#submit-label').html(data.error)

                    }
                }
            });                
    });
    
    
    var d = new Date();
    var y = d.getFullYear();
    var f = y+5;
    var option ='';
    
    for(y; y < f; y++){
        option += '<option>'+y+'</option>';
    }
    
    $('select#ano_validade').html(option);
    
    
});    