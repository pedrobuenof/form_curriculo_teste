document.addEventListener('DOMContentLoaded', function () {
    const botaoSubmit = document.getElementById('btn');

    botaoSubmit.addEventListener('click', function (event) {
        if (!validarCampo('nome', 'Por favor, preencha o campo Nome.')) {
            event.preventDefault();
            return;
        }
        if (!validarCampo('email', 'Por favor, preencha o campo E-mail.')) {
            event.preventDefault();
            return;
        }
        if (!validarCampo('telefone', 'Por favor, preencha o campo Telefone.')) {
            event.preventDefault();
            return;
        }
        if (!validarCampo('cargo', 'Por favor, preencha o campo Cargo.')) {
            event.preventDefault();
            return;
        }
        if (!validarCampo('escolaridade', 'Por favor, escolha 1 valor para o campo Escolaridade.')) {
            event.preventDefault();
            return;
        }
        // Continue com as validações dos outros campos...

        const arquivoInput = document.getElementById('arquivo_path');
        const arquivo = arquivoInput.files[0]
        
        
        if (!validarArquivoSelecionado(arquivo)) {
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

    function validarCampo(campoId, mensagemErro) {
        const campo = document.getElementById(campoId).value.trim();
        if (campo === '') {
            alert(mensagemErro);
            return false;
        }
        return true;
    }

    function validarArquivoSelecionado(arquivo) {
        if (!arquivo) {
            alert('Por favor, selecione um arquivo.');
            return false;
        }
        return true;
    }

    function validarFormatoArquivo(arquivo) {
        console.log(arquivo)
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
});

