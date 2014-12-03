    
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
    
    $('button#pagamento').click(function(){
        
        var nome = $('input#nome-titular').val();
        var mes = $('select#mes_validade').val();        
        var ano = $('select#ano_validade').val();
        var numero = $('input#card-number').val();
        var secure = $('input#secure-number').val();
        var n = $( "#box_credcard input:checked" ).length;
        var id_horario = $('input#id_horario').val();
        
        if(nome == ""){
            alert('preencha o nome do titular');
        }else if( n <=0 ){
            alert('nenhum cartão de crédito selecionado');
        }else if( isNaN(mes) || isNaN(ano) ){
            alert('selecione a validade do cartão');
            
        }else if( isNaN(parseInt(numero)) || isNaN(secure) ){
            alert('número do cartão inválido ');            
        }else{
            AjaxRequest('/consulta/efetua-pagamento/id/'+id_horario+'/nome/'+nome+'/validade/'+mes+ano+'/numero/'+numero+''+secure,'get','#box_credcard');
        }
        
       
    });
    
    var d = new Date();
    var y = d.getFullYear();
    var f = y+5;
    var option ='';
    
    option += '<option value="" ></option>';
    
    for(y; y < f; y++){
        option += '<option value='+y+' >'+y+'</option>';
    }
    
    $('select#ano_validade').html(option);
    
    
});    