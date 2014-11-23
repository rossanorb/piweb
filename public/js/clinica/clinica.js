

function getData(){
    var sdt = $( "#aghorarios" ).datepicker( "getDate");
    sdt = sdt.getFullYear()+'-'+  (sdt.getMonth()+1) +'-'+ sdt.getDate();    
    return sdt;
}

function  has_medico(id_medico){
    if(id_medico == 0) {                
        $(".erro").html("<p>selecione um médico</p>");
        return false;
    }else{
        $(".erro").html("");
        return true;
    } 
    return false;
}

function has_horario(n){            
    if(n<=0){
        $(".erro").html("<p>selecione ao menos</p>  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; um horário</p>");
        return false;
    }else{
        return true;
    }
    return false;
}


$(function() {
        
    $("#aghorarios").datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
        /*
        onSelect: function(){
           var data = $( "#aghorarios" ).datepicker( "getDate");
           var dia = data.getFullYear()+'-'+  (data.getMonth()+1) +'-'+ data.getDate()  ;
           $("#data").val(dia);
        }
        */
        
    });
    

        
    $("#add").click(function(){
            var data = $("#data");
            var n = $( "input:checked" ).length;            
            var id_medico = $("#medicos").val();            
            var hrs=[];
            var sdt = getData();
            
            $("input[type='checkbox']:checked").each(function(i){
               hrs[i] = $(this).attr('id');
            });
                        
            if(!has_medico(id_medico))return;
            
            if(!has_horario(n))return;
            
            $.ajax({
                dataType : 'json',
                type 	 : 'post',
                url      : '/clinica/horarios/add-horarios',
                data     : {
                    data   : sdt,
                    horarios :hrs,
                    id_medico: id_medico
                },
                beforeSend  : function() {
                    
                },
                success     : function(data){
                    if(data.status){
                        alert("horarios adicionados \n com sucesso!");
                    }
                    else{
                        alert(data.error);

                    }
                }
            });
            
            AjaxRequest('/clinica/horarios/list-horarios/id/'+id_medico,'POST','#column-right');
                
    });
    
    
    $(".excluir").click(function(){        
       var id_medico = $("#medicos").val(); 
       var id =  $(this).attr('id');       
       AjaxRequest('/clinica/horarios/dl/id/'+id,'POST','.erro');       
       AjaxRequest('/clinica/horarios/list-horarios/id/'+id_medico,'POST','#column-right');
    });

    
});
