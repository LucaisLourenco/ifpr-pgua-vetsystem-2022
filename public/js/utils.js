//MOSTRAR MODALS SUCCESS
function showInfoModalSuccess() {
    $('#infoModalSuccess').modal().find('.modal-body').html("");
    for(let a=0; a< arguments.length; a++) {
        $('#infoModalSuccess').modal().find('.modal-body').append("<h7><strong> Hi! </strong>" + arguments[a] + "</h7>");
    }
    $("#infoModalSuccess").modal('show');
}

function closeInfoModalSuccess() {
    $("#infoModalSuccess").modal('hide');
}

//MOSTRAR MODALS DANGER
function showInfoModalDanger() {
    $('#infoModalDanger').modal().find('.modal-body').html("");
    for(let a=0; a< arguments.length; a++) {
        $('#infoModalDanger').modal().find('.modal-body').append("<h7><strong> Hi! </strong>" + arguments[a] + "</h7>");
    }
    $("#infoModalDanger").modal('show');
}

function closeInfoModalDanger() {
    $("#infoModalDanger").modal('hide');
}

//MOSTRAR MODALS ENDERECO
function showInfoModalEndereco(nome, cep, rua, numero, complemento, bairro, cidade, uf ) {
    $('#infoModalEndereco').modal().find('.modal-body').html("");
    $('#infoModalEndereco').modal().find('.modal-body').append("<strong>Nome do Endereço: </strong>"+"<em>"+nome+"</em><br>");
    $('#infoModalEndereco').modal().find('.modal-body').append("<strong>CEP: </strong>"+"<em>"+cep+"</em><br>");
    $('#infoModalEndereco').modal().find('.modal-body').append("<strong>Rua: </strong>"+"<em>"+rua+"</em><br>");
    $('#infoModalEndereco').modal().find('.modal-body').append("<strong>Número: </strong>"+"<em>"+numero+"</em><br>");
    $('#infoModalEndereco').modal().find('.modal-body').append("<strong>complemento: </strong>"+"<em>"+complemento+"</em><br>");
    $('#infoModalEndereco').modal().find('.modal-body').append("<strong>Bairro: </strong>"+"<em>"+bairro+"</em><br>");
    $('#infoModalEndereco').modal().find('.modal-body').append("<strong>Cidade: </strong>"+"<em>"+cidade+"</em><br>");
    $('#infoModalEndereco').modal().find('.modal-body').append("<strong>UF: </strong>"+"<em>"+uf+"</em><br>");
    $("#infoModalEndereco").modal('show');
}

function closeInfoModalEndereco() {
    $("#infoModalEndereco").modal('hide');
}

//MODAL REMOVER
function showRemoveModal(id, nome) {
    $('#id_remove').val(id);
    $('#removeModal').modal().find('.modal-body').html("");
    $('#removeModal').modal().find('.modal-body').append("Deseja remover o registro <b class='text-danger'>'"+nome+"'</b> ?");
    $("#removeModal").modal('show');
}

function closeRemoveModal() {
    $("#removeModal").modal('hide');
}

function remove() {
    let id = $('#id_remove').val();
    let form = "form_" + $('#id_remove').val();
    document.getElementById(form).submit();
    $("#removeModal").modal('hide')
}

//MODAL REMOVE ENDERECO
function showRemoveModalEndereco(id, nome) {
    $('#id_remove').val(id);
    $('#removeModalEndereco').modal().find('.modal-body').html("");
    $('#removeModalEndereco').modal().find('.modal-body').append("Deseja remover o registro <b class='text-danger'>'"+nome+"'</b> ?");
    $("#removeModalEndereco").modal('show');
}

function closeRemoveModalEndereco() {
    $("#removeModalEndereco").modal('hide');
}

function removeEndereco() {
    let id = $('#id_remove').val();
    let form = "endereco_" + $('#id_remove').val();
    document.getElementById(form).submit();
    $("#removeModalEndereco").modal('hide')
}

//MODAL REMOVE TELEDONE
function showRemoveModalTelefone(id, nome) {
    $('#id_remove').val(id);
    $('#removeModalTelefone').modal().find('.modal-body').html("");
    $('#removeModalTelefone').modal().find('.modal-body').append("Deseja remover o registro <b class='text-danger'>'"+nome+"'</b> ?");
    $("#removeModalTelefone").modal('show');
}

function closeRemoveModalTelefone() {
    $("#removeModalTelefone").modal('hide');
}

function removeTelefone() {
    let id = $('#id_remove').val();
    let form = "telefone_" + $('#id_remove').val();
    document.getElementById(form).submit();
    $("#removeModalTelefone").modal('hide')
}

//MODAL REMOVE PET
function showRemoveModalPet(id, nome) {
    $('#id_remove').val(id);
    $('#removeModalPet').modal().find('.modal-body').html("");
    $('#removeModalPet').modal().find('.modal-body').append("Deseja remover o registro <b class='text-danger'>'"+nome+"'</b> ?");
    $("#removeModalPet").modal('show');
}

function closeRemoveModalPet() {
    $("#removeModalPet").modal('hide');
}

function removePet() {
    let id = $('#id_remove').val();
    let form = "pet_" + $('#id_remove').val();
    document.getElementById(form).submit();
    $("#removeModalPet").modal('hide')
}

//MODAL REMOVE CLIENTE
function showRemoveModalCliente(id, nome) {
    $('#id_remove').val(id);
    $('#removeModalCliente').modal().find('.modal-body').html("");
    $('#removeModalCliente').modal().find('.modal-body').append("Deseja remover o registro <b class='text-danger'>'"+nome+"'</b> ?");
    $("#removeModalCliente").modal('show');
}

function closeRemoveModalCliente() {
    $("#removeModalCliente").modal('hide');
}

function removeCliente() {
    let id = $('#id_remove').val();
    let form = "cliente_" + $('#id_remove').val();
    document.getElementById(form).submit();
    $("#removeModalCliente").modal('hide')
}

//MODAL REMOVE FORM2
function showRemoveModalForm2(id, nome) {
    $('#id_remove').val(id);
    $('#removeModalForm2').modal().find('.modal-body').html("");
    $('#removeModalForm2').modal().find('.modal-body').append("Deseja remover o registro <b class='text-danger'>'"+nome+"'</b> ?");
    $("#removeModalForm2").modal('show');
}

function closeRemoveModalForm2() {
    $("#removeModalForm2").modal('hide');
}

function removeForm2() {
    let id = $('#id_remove').val();
    let form = "form2_" + $('#id_remove').val();
    document.getElementById(form).submit();
    $("#removeModalForm2").modal('hide')
}

//FUNCOES
$(document).ready(function(){
    setTimeout(() => {
        $(".alert").fadeOut("slow", function(){
            $(this).alert('close');
        })
    }, 4000);
});

$(document).ready(function(){
    setTimeout(() => {
        closeInfoModalDanger();
        closeInfoModalSuccess();
    }, 10000);
});

//API VIACEP
$(document).ready(function() {

    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#rua").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#uf").val("");
        $("#ibge").val("");
    }
    
    //Quando o campo cep perde o foco.
    $("#cep").blur(function() {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#rua").val("...");
                $("#bairro").val("...");
                $("#cidade").val("...");
                $("#complemento").val("...");
                $("#uf").val("...");
                $("#ibge").val("...");

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#rua").val(dados.logradouro);
                        $("#bairro").val(dados.bairro);
                        $("#cidade").val(dados.localidade);
                        $("#complemento").val(dados.complemento);
                        $("#uf").val(dados.uf);
                        $("#ibge").val(dados.ibge);
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        $(document).ready(function(){
                            showInfoModalDanger("CEP não encontrado.");
                        });                                
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                $(document).ready(function(){
                    showInfoModalDanger("Formato de CEP inválido.");
                });
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });
});

//MÁSCARA DE CPF
function fMasc(objeto,mascara) {
    obj=objeto
    masc=mascara
    setTimeout("fMascEx()",1)
}
function fMascEx() {
    obj.value=masc(obj.value)
}

function mCNPJ(cnpj){
    cnpj=cnpj.replace(/\D/g,"")
    cnpj=cnpj.replace(/^(\d{2})(\d)/,"$1.$2")
    cnpj=cnpj.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")
    cnpj=cnpj.replace(/\.(\d{3})(\d)/,".$1/$2")
    cnpj=cnpj.replace(/(\d{4})(\d)/,"$1-$2")
    return cnpj
}
function mCPF(cpf){
    cpf=cpf.substring(0, 14)
    cpf=cpf.replace(/\D/g,"")
    cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
    cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
    cpf=cpf.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
    return cpf
}
function mCEP(cep){
    cep=cep.substring(0, 10)
    cep=cep.replace(/\D/g,"")
    cep=cep.replace(/^(\d{2})(\d)/,"$1.$2")
    cep=cep.replace(/\.(\d{3})(\d)/,".$1-$2")
    return cep
}

function mPeso(peso){
    peso=peso.substring(0, 6)
    peso=peso.replace(/\D/g,"")
    peso=peso.replace(/(\d{2})(\d)/,"$1.$2")
    return peso
}

//MÁSCARA DE TELEFONE
function mask(o, f) {
    setTimeout(function() {
        var v = mphone(o.value);
        if (v != o.value) {
            o.value = v;
        }
    }, 1);
}

function mphone(v) {
    var r = v.replace(/\D/g, "");
    r = r.replace(/^0/, "");
    if (r.length > 10) {
        r = r.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
    } else if (r.length > 5) {
        r = r.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
    } else if (r.length > 2) {
        r = r.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
    } else {
        r = r.replace(/^(\d*)/, "($1");
    }
    return r;
}