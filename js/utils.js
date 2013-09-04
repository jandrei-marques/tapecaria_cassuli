function openModal(id) {
    $("#" + id).dialog("open");
}

$(document).ready(function() {
    $("#cpf").mask("999.999.999-99");
    $("#cnpj").mask("99.999.999/9999-99");
    $("#fone").mask("+55(99)9999-9999");
    $("#celular").mask("+55(99)9999-9999");

    $(".btnSave").button({icons: {primary: 'ui-icon-check'}});
    $(".btnClose").button({icons: {primary: 'ui-icon-closethick'}});
    $(".btnCancelar").button({icons: {primary: 'ui-icon-circle-close'}});
    $(".btnAdd").button({icons: {primary: 'ui-icon-plus'}});

    $(".dialog-form").dialog({
        autoOpen: false,
        height: 430,
        width: 500,
        resizable: false,
        closeText: "Sair",
        modal: true,
        buttons: {
        }
    });
    $("#formUsuario").validate({
        errorElement: "error",
        wrapper: "error",
        rules: {
            senha: {
                required: true,
                minlength: 8
            },
            confirmacaosenha: {
                required: true,
                minlength: 8,
                equalTo: "#senha"
            }
        },
        messages: {
            senha: {
                required: "Informe uma senha",
                minlength: "Mínimo 8 caracteres"
            },
            confirmacaosenha: {
                required: "Informe uma senha",
                minlength: "A senha deve conter no mínimo 8 caracteres",
                equalTo: "Senhas diferentes. Verifique!"
            }
        }
    });
});

function somenteNumero(e) {
    var tecla = (window.event) ? event.keyCode : e.which;
    if ((tecla > 47 && tecla < 58))
        return true;
    else {
        if (tecla != 8 && tecla != 0)
            return false;
        else
            return true;
    }
}

function validate(id) {
    if ($(id).val() == 0) {
        id.style.border = "1px solid red";
        id.focus();
        alert("Selecione uma opção!");
        return false;
    }
    return true;
}
function submitFormConfirm(form, valor) {
    decisao = confirm(valor);
    if (decisao) {
        return document.forms[form].submit();
        return true;
    }
    return false;
}