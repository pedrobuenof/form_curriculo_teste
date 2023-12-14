<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Currículo Enviado</title>
</head>
<body>
    <h1>Novo Currículo Enviado</h1>

    <p>Candidato Número: {{ $dataDb['id'] }}</p>
    <p>Nome: {{ $dataDb['nome'] }}</p>    
    <p>Email: {{ $dataDb['email'] }}</p>
    <p>Telefone: {{ $dataDb['telefone'] }}</p>
    <p>Cargo: {{$dataDb['cargo']}}</p>
    <p>Escolaridade: {{$dataDb['escolaridade']}}</p>
    @if($dataDb['observacoes'])
        <p>Observações: {{ $dataDb['observacoes'] }}</p>
    @endif
    <p>O ip do candidato é o: {{$dataDb['ip']}}</p>
    <p>A data e hora que o candidato realizou sua candidatura: {{\Carbon\Carbon::parse($dataDb['created_at'])->timezone('America/Sao_Paulo')->format('d/m/Y H:i:s')}}</p>

</body>
</html>