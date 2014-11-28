function ValidarCPF(cpf){
        exp = /\.|\-/g
        cpf = cpf.toString().replace( exp, "" ); 
        var digitoDigitado = eval(cpf.charAt(9)+cpf.charAt(10));
        var soma1=0, soma2=0;
        var vlr =11;

        for(i=0;i<9;i++){
                soma1+=eval(cpf.charAt(i)*(vlr-1));
                soma2+=eval(cpf.charAt(i)*vlr);
                vlr--;
        }       
        soma1 = (((soma1*10)%11)==10 ? 0:((soma1*10)%11));
        soma2=(((soma2+(2*soma1))*10)%11);

        var digitoGerado=(soma1*10)+soma2;
        return ( (digitoGerado!=digitoDigitado)? false : true );

}   

function ValidaEmail(email){
    if(email != ""){        
       var filtro = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;                  
       if((filtro.test(email)))  return true; else  return false       
    } else {
       return false;
    }       
}


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
    $('#cnpj').mask('00000000/0000-00',{reverse:true});
    $('#cep').mask('99999-999');
    $('#telefone').mask("(99) 9999-99999", {placeholder: "(__) ____-_____"});    
    $('#numero').mask('99999999');
    $('input#card-number').mask('0000 0000 0000 0000');


    $('#bt #button').click(function(){
         var id = $("select#especialidades").val();
         if(id >0 ){
             $(window.document.location).attr('href','/index/busca/especialidade/'+id);
         }
    });
    
    
    $('.bt-confirma #button').click(function(){
         var n = $( "input:checked" ).length;
         
         if(n == 0){
             alert('Nenhum horário selecionado!');
         }else if(n > 1){
             alert('Só é possível selecionar um horário ');
         }else{
             var id_horario =  $("input[type='checkbox']:checked").attr('id');
             
             if(id_horario > 0 ){
                $(window.document.location).attr('href','/consulta/index/id/'+id_horario);
             }

         }        
             
    });
    
    



    
});


