document.addEventListener('DOMContentLoaded', function () {
    const botaoSubmit = document.getElementById('btn');

    botaoSubmit.addEventListener('click', function (event) {
        if (!validarCampoVazio('nome', 'Por favor, preencha o campo Nome.')) {
            event.preventDefault();
            return;
        }
        if (!validarCampoVazio('email', 'Por favor, preencha o campo E-mail.')) {
            event.preventDefault();
            return;
        }
        if (!validarCampoVazio('telefone', 'Por favor, preencha o campo Telefone.')) {
            event.preventDefault();
            return;
        }
        if (!validarCampoVazio('cargo', 'Por favor, preencha o campo Cargo.')) {
            event.preventDefault();
            return;
        }
        if (!validarCampoVazio('escolaridade', 'Por favor, escolha 1 valor para o campo Escolaridade.')) {
            event.preventDefault();
            return;
        }
        
        const emailInput = document.getElementById('email');
        const email = emailInput.value.trim();

        if(!validarEmail(email, 'Formato de e-mail inválido.')){
            event.preventDefault();
            return;
        }

        const arquivoInput = document.getElementById('arquivo_path');
        const arquivo = arquivoInput.files[0]
        
        
        if (!arquivoSelecionado(arquivo)) {
            event.preventDefault();
            return;
        }
        if (!validarFormatoArquivo(arquivo)) {
            event.preventDefault();
            return;
        }
        if (!validarTamanhoArquivo(arquivo, 1024 * 1024, 'O tamanho do arquivo não pode exceder 1MB.')) {
            event.preventDefault();
            return;
        }
    });

    function validarCampoVazio(campoId, mensagemErro) {
        const campo = document.getElementById(campoId).value.trim();
        if (campo === '') {
            alert(mensagemErro);
            return false;
        }
        return true;
    }

    function arquivoSelecionado(arquivo) {
        if (!arquivo) {
            alert('Por favor, selecione um arquivo.');
            return false;
        }
        return true;
    }

    function validarFormatoArquivo(arquivo) {
        //console.log(arquivo)
        const formatosPermitidos = ['application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/pdf'];
        const extensao = arquivo.type;

        if (!formatosPermitidos.includes(extensao)) {
            alert('Formato de arquivo não permitido. Use .doc, .docx ou .pdf.');
            return false;
        }
        return true;
    }

    function validarTamanhoArquivo(arquivo, tamanhoMaximo, mensagemErro) {
        if (arquivo.size > tamanhoMaximo) {
            alert(mensagemErro);
            return false;
        }
        return true;
    }

    function validarFormatoEmail(email) {
        const regexEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!regexEmail.test(email)) {
            return false;
        }
        return true;
    }

    function validarEmail(email, mensagemErro) {
        console.log(email)
        if (!validarFormatoEmail(email)) {
            alert(mensagemErro);
            return false;
        }
        return true;
    }
});

