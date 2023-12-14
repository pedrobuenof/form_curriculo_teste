<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

Projeto Laravel de Cadastro de Currículos

Sobre o Projeto
Este é um projeto Laravel para gerenciar o cadastro de currículos, incluindo validações no front-end e no back-end, envio de e-mails assíncrono usando jobs, filas e workers.

Estrutura do Projeto
Controller (CadastrarCurriculo):

Localizado em App\Http\Controllers\CadastrarCurriculo.php.
Responsável por gerenciar a lógica de cadastro de currículos.
Utiliza os serviços de cadastro (CadastrarServico) e envio de e-mail (EnviarEmailServico).
Serviço de Cadastro (CadastrarServico):

Localizado em App\Servicos\CadastrarServico.php.
Realiza o tratamento dos dados de entrada, salvando arquivos e interagindo com o repositório.
Trata exceções durante a execução e realiza logs.
Serviço de Envio de E-mail (EnviarEmailServico):

Localizado em App\Servicos\EnviarEmailServico.php.
Encarregado de enfileirar o job de envio de e-mail (EnviarCurriculoJob) para ser processado assincronamente.
Trata exceções e realiza logs.
Job de Envio de E-mail (EnviarCurriculoJob):

Localizado em App\Jobs\EnviarCurriculoJob.php.
Implementa a lógica de envio de e-mail assíncrono.
Utiliza a classe CurriculoEnviado para compor o conteúdo do e-mail.
E-mail (CurriculoEnviado):

Localizado em App\Mail\CurriculoEnviado.php.
Mailable para criar e enviar o e-mail.
Anexa o currículo ao e-mail se o arquivo existir.
Requests de Validação (CurriculoRequest):

Localizado em App\Http\Requests\CurriculoRequest.php.
Define as regras de validação para os dados de entrada da API.
Model (Curriculo):

Localizado em App\Models\Curriculo.php.
Representa a estrutura do modelo de dados do currículo.
Define campos preenchíveis e relacionamentos.
Migration (create_curriculos_table):

Localizado em database/migrations/YYYY_MM_DD_create_curriculos_table.php.
Criação da tabela curriculos no banco de dados.
Validação Front-end (validacao_front_end.js):

Localizado em public/js/validacao_front_end.js.
Script JavaScript para validar campos do formulário no lado do cliente.
Configuração e Instalação
Clonar o Repositório:

bash
Copy code
git clone https://github.com/seu-usuario/projeto-cad-curriculos.git
Instalar Dependências:

bash
Copy code
cd projeto-cad-curriculos
composer install
Configurar o Ambiente:

Copiar o arquivo .env.example para .env.
Configurar as informações do banco de dados, filas e e-mails no arquivo .env.
Gerar Chave de Aplicativo:

bash
Copy code
php artisan key:generate
Executar Migrações:

bash
Copy code
php artisan migrate
Iniciar Servidor de Desenvolvimento:

bash
Copy code
php artisan serve
Uso da API
Endpoint de Cadastro:
POST /api/cadastrar-curriculo
Parâmetros:
nome: Nome do candidato (obrigatório).
email: E-mail do candidato (obrigatório e único).
telefone: Telefone do candidato (obrigatório).
cargo: Cargo desejado (obrigatório).
escolaridade: Nível de escolaridade (obrigatório).
observacoes: Observações adicionais (opcional).
arquivo_path: Arquivo do currículo (obrigatório).
Observações
Certifique-se de ter o Composer e o Laravel instalados.
Este é um projeto básico e pode ser expandido com mais recursos, autenticação, e-mails de confirmação, entre outros.
Considerações Finais
Este projeto é um ponto de partida para um sistema de cadastro de currículos em Laravel, com uma ar





