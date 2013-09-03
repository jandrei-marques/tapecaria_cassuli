function openModal(id){  
    $( "#"+id ).dialog( "open" );
}

function printDiv(printdivname){
    var newstr = document.getElementById(printdivname).innerHTML;
    var oldstr = document.getElementById('te').innerHTML;
    document.body.innerHTML = newstr;
    window.print();
    document.body.innerHTML = oldstr;
//return false;
}

$(document).ready(function(){    
    $(".cpf").mask("999.999.999-99");
    $(".fone").mask("+55(99)9999-9999");
    $(".celular").mask("+55(99)9999-9999");
    
    $(".valor").maskMoney({symbol:"R$ ",decimal:",",thousands:".",allowNegative:false,defaultZero:false});
    $(".mensalidade").maskMoney({symbol:"R$ ",decimal:",",thousands:".",allowNegative:false,defaultZero:false});
    
    $(".btnSave").button({icons:{primary:'ui-icon-check'} });
    $(".btnClose").button({icons:{primary:'ui-icon-closethick'} });
    $(".btnPagar").button({icons:{primary:'ui-icon-circle-check'} });
    $(".btnCancelar").button({icons:{primary:'ui-icon-circle-close'} });
    $(".btnAdd").button({icons:{primary:'ui-icon-plus'} });
    $(".btnImprimir").button({icons:{primary:'ui-icon-print'} });
    $(".btnContrato").button({icons:{primary:'ui-icon-script'} });
    $(" .tabs ").tabs({active: 1});
    $(" .tabsConta ").tabs();
    $( ".dialog-form" ).dialog({
        autoOpen: false,
        height: 430,
        width: 500,
        resizable: false,
        closeText: "Sair",
        modal: true,
        buttons: {
        }
    });
    $( ".dialog-form-sms" ).dialog({
        autoOpen: false,
        height: 320,
        width: 500,
        resizable: false,
        closeText: "Sair",
        modal: true,
        buttons: {
        }
    });
    $( ".dialog-form-contrato" ).dialog({
        autoOpen: false,
        height: 670,
        width: 700,
        resizable: false,
        closeText: "Sair",
        modal: true,
        buttons: {
        }
    });
});

function somenteNumero(e){
    var tecla=(window.event)?event.keyCode:e.which;
    if((tecla >47 && tecla <58)) 
        return true;
    else{
        if(tecla !=8 && tecla != 0) 
            return false;
                else 
                    return true;
        }	
}

function validate(id){
    if($(id).val() == 0){        
        id.style.border= "1px solid red";
        id.focus();
        alert("Selecione uma opção!");
        return false;
    }
    return true;
}
function submitFormConfirm(form, valor){
    decisao = confirm(valor);
    if (decisao){
        return document.forms[form].submit();
        return true;
    }
    return false;
}

function validateVariation(){
    if(document.getElementById('bonus').checked == true){
        document.getElementById('dataPagamento').disabled = true;
        document.getElementById("valorPagamento").disabled = true;         
    }else {
        document.getElementById('dataPagamento').disabled = false;
        document.getElementById("valorPagamento").disabled = false;           
    }
}

function validaPagto(){
    if(document.getElementById('pago').checked == true){
        document.getElementById('dataPgto').disabled = true;
    }else{
        document.getElementById('dataPgto').disabled = false;
    }
}