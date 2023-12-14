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
        <form action="/cadastrar" method="POST" enctype="multipart/form-data" id="form">
            @csrf
            <div class="nome">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" placeholder="Escreva seu nome aqui" required >
            </div>

            <div class="email">
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" placeholder="Escreva seu e-mail aqui" required>
            </div>

            <div class="telefone">
                <label for="telefone">Telefone:</label>
                <input type="text" name="telefone" id="telefone" placeholder="Ex: 84988887777" required >
                <!-- <input type="tel" name="telefone" id="telefone" required> -->
            </div>

            <div class="cargo">
                <label for="cargo">Cargo:</label>
                <input type="text" name="cargo" id="cargo" placeholder="Informe o cargo desejado" required>
            </div>

            <div class="escolaridade">
                <label for="escolaridade">Escolaridade:</label>
                <select name="escolaridade" id="escolaridade" required>
                    <option value="" disabled selected>Selecione a Escolaridade</option>
                    <option value="ensino_medio">Ensino Médio</option>
                    <option value="cursando_ensino_superior">Cursando Ensino Superior</option>
                    <option value="ensino_superior_concluido">Ensino Superior Concluído</option>
                </select>
                
            </div>

            <div class="observacoes">
                <label for="observacoes">Observações:</label>
                <textarea name="observacoes" id="observacoes" cols="30" rows="10"></textarea>
            </div>

            <div class="arquivo">
                <label for="arquivo_path">Currículo:</label>
                <input type="file" name="arquivo_path" id="arquivo_path" required>
            </div>

            <button type="submit" id="btn">Enviar Candidatura</button>
        </form>
    </div>
</body>
</html>