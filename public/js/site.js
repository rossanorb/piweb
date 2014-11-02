    function AjaxRequest(url,type,objeto){
            $.ajax({
                    type: type,
                    url:url,
                    success: function(retorno){
                            $(objeto).html(retorno);
                    }

            })
    }
    

    
$(document).ready(function(){
        
    $('#data').mask("00/00/0000", {placeholder: "__/__/____"});
    $('#rg').mask('9999999999');    
    $('#cpf').mask('000.000.000-00', {reverse: true});
    $('#cep').mask('99999-999');
    $('#telefone').mask("(99) 9999-99999", {placeholder: "(__) ____-_____"});    
    $('#numero').mask('99999999');

    
});