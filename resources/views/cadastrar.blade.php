<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vagas.com</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script src="{{asset('js/validation.js')}}" defer></script>
</head>
<body>
    <div class="container">
        <h1>Envie a sua candidatura aqui!</h1>
        <div class="obs">
            <span style="color: red">            
                <strong>
                    Marcações com * são de obrigatório preenchimento.
                </strong>            
            </span>
        </div>
        <form action="/cadastrar" method="POST" enctype="multipart/form-data" id="form">
            @csrf
            <div class="input_box nome">
                <label for="nome">Nome <span class="required">*</span>:</label>
                <input type="text" name="nome" id="nome" placeholder="Escreva seu nome aqui" required >
            </div>

            <div class="input_box email">
                <label for="email">E-mail <span class="required">*</span>:</label>
                <input type="email" name="email" id="email" placeholder="Escreva seu e-mail aqui" required>
            </div>

            <div class="input_box telefone">
                <label for="telefone">Telefone <span class="required">*</span>:</label>
                <input type="text" name="telefone" id="telefone" placeholder="Ex: 84988887777" required >
            </div>

            <div class="input_box cargo">
                <label for="cargo">Cargo <span class="required">*</span>:</label>
                <input type="text" name="cargo" id="cargo" placeholder="Informe o cargo desejado" required>
            </div>

            <div class="input_box escolaridade">
                <label for="escolaridade">Escolaridade <span class="required">*</span>:</label>
                <select name="escolaridade" id="escolaridade" required>
                    <option value="" disabled selected>Selecione a Escolaridade</option>
                    <option value="ensino_medio">Ensino Médio</option>
                    <option value="cursando_ensino_superior">Cursando Ensino Superior</option>
                    <option value="ensino_superior_concluido">Ensino Superior Concluído</option>
                </select>
                
            </div>

            <div class="input_box observacoes">
                <label for="observacoes">Observações:</label>
                <textarea name="observacoes" id="observacoes" cols="30" rows="10"></textarea>
            </div>

            <div class="input_box arquivo">
                <label for="arquivo_path" class="arquivo_path"> <strong>Clique aqui para enviar o Currículo <span class="required">*</span></strong></label>
                <input type="file" name="arquivo_path" id="arquivo_path" required>
            </div>

            <button type="submit" id="btn">Enviar Candidatura</button>
        </form>
    </div>
</body>
</html>