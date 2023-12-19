# Projeto Laravel de Cadastro de Currículos

## Sobre o Projeto

Este é um projeto Laravel para gerenciar o cadastro de currículos, incluindo validações no front-end e no back-end, envio de e-mails assíncrono usando jobs, filas e workers.

## Estrutura do Projeto

### Controller (CadastrarCurriculo):

Localizado em `App\Http\Controllers\CadastrarCurriculo.php`.
Responsável por gerenciar a lógica de cadastro de currículos.
Utiliza os serviços de cadastro (CadastrarServico) e envio de e-mail (EnviarEmailServico).

### Serviço de Cadastro (CadastrarServico):

Localizado em `App\Servicos\CadastrarServico.php`.
Realiza o tratamento e manipulação dos dados de entrada, salvando arquivos e interagindo com o repositório.
Trata exceções durante a execução e realiza logs.

### Serviço de Envio de E-mail (EnviarEmailServico):

Localizado em `App\Servicos\EnviarEmailServico.php`.
Encarregado de enfileirar o job de envio de e-mail (EnviarCurriculoJob) para ser processado assincronamente.
Trata exceções e realiza logs.

### Job de Envio de E-mail (EnviarCurriculoJob):

Localizado em `App\Jobs\EnviarCurriculoJob.php`.
Implementa a lógica de envio de e-mail assíncrono.
Utiliza a classe CurriculoEnviado para compor o conteúdo do e-mail.

### E-mail (CurriculoEnviado):

Localizado em `App\Mail\CurriculoEnviado.php`.
Mailable para criar e enviar o e-mail.
Anexa o currículo ao e-mail se o arquivo existir.

### Requests de Validação (CurriculoRequest):

Localizado em `App\Http\Requests\CurriculoRequest.php`.
Define as regras de validação para os dados de entrada da API.

### Model (Curriculo):

Localizado em `App\Models\Curriculo.php`.
Representa a estrutura do modelo de dados do currículo.
Define campos preenchíveis e relacionamentos.

### Migration (curriculo):

Localizado em `database/migrations/curriculo.php`.
Criação da tabela curriculos no banco de dados.

### Validação Front-end (validation.js):

Localizado em `public/js/validation.js`.
Script JavaScript para validar campos do formulário no lado do cliente.

## Configuração e Instalação

1. **Clonar o Repositório:**
    ```bash
    git clone https://github.com/pedrobuenof/form_curriculo_teste.git
    ```

2. **Instalar Dependências:**
    ```bash
    cd projeto-form-curriculos
    composer install
    ```

3. **Configurar o Ambiente:**
    - Copiar o arquivo `.env.example` para `.env`.
    - Configurar as informações do banco de dados, filas e e-mails no arquivo `.env`.


4. **Executar Migrações:**
    ```bash
    php artisan migrate
    ```

5. **Iniciar Servidor de Desenvolvimento:**
    ```bash
    php artisan serve
    ```

## Uso da API

### Endpoint de Cadastro:
- **POST** `/cadastrar`

**Parâmetros:**
- `nome`: Nome do candidato (obrigatório).
- `email`: E-mail do candidato (obrigatório e único).
- `telefone`: Telefone do candidato (obrigatório).
- `cargo`: Cargo desejado (obrigatório).
- `escolaridade`: Nível de escolaridade (obrigatório).
- `observacoes`: Observações adicionais (opcional).
- `arquivo_path`: Arquivo do currículo (obrigatório).

## Observações

- Certifique-se de ter o Composer e o Laravel instalados.
- Este é um projeto básico e pode ser expandido com mais recursos, autenticação, e-mails de confirmação, entre outros.

## Considerações Finais

Este projeto é um ponto de partida para um sistema de cadastro de currículos em Laravel, com uma arquitetura organizada e pronta para ser expandida conforme necessário.





