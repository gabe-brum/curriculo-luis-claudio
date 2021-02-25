// Validate send
// Validar os campos do formulário
function validarForm() {
    var nome    = $('#nome')
    var email   = $('#email')
    var mensagem = $('#mensagem')

    if (!preenchimentoObrigatorio(nome)) {
        return false
    }

    // Retira caracteres não permitidos
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if (!re.test(email)) {
        if (!preenchimentoObrigatorio(email)) {
            return false
        }
    }

    if (!preenchimentoObrigatorio(mensagem)) {
        return false
    }
    
    // Cria um delay (atraso) antes de enviar
    delay()
}

function preenchimentoObrigatorio (campo) {

    // Verifica se o campo obrigatório foi preenchido
    if (campo.val() == "") {
        campo.parent('label').css({
            "color":"#ff6f65"
        })

        campo.focus()
        return false
        
    } else {
        campo.parent('label').css({
            "color":"#ffffff"
        })
    }

    return true
}

function delay() {
    $('#status').text("Enviando")
    
    setTimeout(function() {
        $('#status').text("Enviando.")
    }, 500)

    setTimeout(function() {
        $('#status').text("Enviando..")
    }, 1000)

    setTimeout(function() {
        $('#status').text("Enviando...")
        enviarFormAjax()
    }, 1500)
}

function enviarFormAjax() {
    formData = {
        'nome'		: $('#nome').val(),
        'email'		: $('#email').val(),
        'fone'		: $('#telefone').val(),
        'mensagem'	: $('#mensagem').val()
    };

    $.ajax({
        url : 'envio-email.php',
        type: 'POST',
        data : formData,
        success: function(data) {
            $('#formContato').trigger('reset')
            $('#status').text(data.message)
        },
        error: function(data) {
            $('#status').html(data.message)
        }
    });
}
