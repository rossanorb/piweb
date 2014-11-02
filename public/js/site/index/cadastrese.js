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
           return (filtro.test(email))? true: false;
        } else {
           return false;
        }       
    }

$(document).ready(function(){
    
    AjaxRequest('/site/index/combo/name/'+$('select#uf').attr('name')+'/id/'+ $('select#uf').val(),'GET','#cidade-element');
  
    
    $('select#uf').change(function(){
        AjaxRequest('/site/index/combo/name/'+$('select#uf').attr('name')+'/id/'+ $('select#uf').val(),'GET','#cidade-element');
    })       
    

    $('#cliente').submit(function(event){
        
        $('dd').find('p').each(function(){
             $(this).remove();
        });
        
        if( ($('#nome').val()).length < 10  ){
            $('#nome-element').prepend('<p style="color:red;font-size:14px;">nome informado muito curto</p>');
            return false;
        }
        
        if( ($('#rg').val()).length < 10  ){
            $('#rg-element').prepend('<p style="color:red;font-size:14px;">rg incorreto</p>');
            return false;
        }
        
        
        if( !ValidarCPF( $('#cpf').val() ) ){
            $('#cpf-element').prepend('<p style="color:red;font-size:14px;">cpf incorreto</p>');
            return false;
        }
        
        if( ($('#data').val()).length < 10  ){
            $('#data-element').prepend('<p style="color:red;font-size:14px;">data inválida</p>');
            return false;
        }
        
        if( $('#estado_civil').val() == 0 ){
            $('#estado_civil-element').prepend('<p style="color:red;font-size:14px;">selecione uma opção</p>');
            return false;
        }
        
        if( $('#sexo').val() == 0  ){
            $('#sexo-element').prepend('<p style="color:red;font-size:14px;">selecione uma opção</p>');
            return false;
        }
        
         if( ($('#telefone').val()).length < 14  ){
            $('#telefone-element').prepend('<p style="color:red;font-size:14px;">telefone inválido</p>');
            return false;
        }        
        
         if( ($('#rua').val()).length < 5  ){
            $('#rua-element').prepend('<p style="color:red;font-size:14px;">nome da rua muito curto</p>');
            return false;
        }
        
         if( ($('#numero').val()).length == 0  ){
            $('#numero-element').prepend('<p style="color:red;font-size:14px;">número inválido</p>');
            return false;
        }
        
        
         if( ($('#bairro').val()).length < 5  ){
            $('#bairro-element').prepend('<p style="color:red;font-size:14px;">bairro inválido</p>');
            return false;
        }        
        
        
        if( ($('#uf').val()) == 0  ){
            $('#uf-element').prepend('<p style="color:red;font-size:14px;">uf inválido</p>');
            return false;
        }
        
        
        if( ($('#cidade').val()) == null ){
            $('#cidade-element').prepend('<p style="color:red;font-size:14px;">cidade não selecionada</p>');
            return false;
        }            
        
        
        if( ($('#cep').val()).length < 9  ){
            $('#cep-element').prepend('<p style="color:red;font-size:14px;">cep inválido</p>');
            return false;
        } 
        
        if( !ValidaEmail($('#email').val() ) ){
            $('#email-element').prepend('<p style="color:red;font-size:14px;">email inválido</p>');
            return false;
        }
        
        if( ($('#senha').val()).length < 6  ){
            $('#senha-element').prepend('<p style="color:red;font-size:14px;">a senha deve ter pelo menos 6 caracteres</p>');
            return false;
        }
        
        alert('enviando form');
       return false;
    });    
    
    
});