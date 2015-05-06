$(document).ready(function(){
   $('input[type="button"]').click(function(){
       $(this).val('enviado');
       var id = $(this).attr('id');
       //$(window.document.location).attr('href','adm/index/send/'+id); 
   });
   
   $('select[name="medicos"]').change(function(){
       var id = $(this).val();
       var action = $(this).attr('id');
       $(window.document.location).attr('href','/adm/index/'+action+'/id/'+id); 
   });
   
   $('input[type="checkbox"]').click(function(){
       //console.log('id',$(this).attr('id'));
       //console.log('checked', $(this).attr('checked'));
       
       var id_clinica = $(this).attr('id');
       var id_medico = $('select#vincular-medico').val();
       var id_clinicas_medicos = $(this).attr('value') ? $(this).attr('value') : null  ;
       
        if($(this).attr("checked")=="checked"){
            var checked = 0;
        }else{
            var checked = 1;
        }           
       
       
       
        $.ajax({
                dataType : 'json',
                type : 'post',
                url : '/adm/index/vincular/',
            data     : {
                id_clinica : id_clinica,                    
                id_medico:id_medico,
                id_clinicas_medicos :id_clinicas_medicos, 
                checked:checked
            },
            beforeSend  : function() {

            },
            success     : function(data){
                    if(data.status){
                        alert(data.status);                        
                    }
                    else{
                        alert('não foi possível executar a operação');

                    }
                    $(window.document.location).attr('href','/adm/index/vincular-medico/id/'+id_medico); 
            }
        }); 
       
   });

    
});