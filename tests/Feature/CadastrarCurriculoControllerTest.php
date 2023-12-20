<?php

namespace Tests\Feature;

use App\Http\Controllers\CadastrarCurriculo;
use App\Http\Requests\CurriculoRequest;
use App\UseCases\CadastrarInterface;
use App\UseCases\EnviarEmailInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class CadastrarCurriculoControllerTest extends TestCase
{
    public function test_se_os_dados_forem_validos_o_retorno_deve_ser_sucesso()
    {
        // Arrange
        $cadastrarMock = $this->createMock(CadastrarInterface::class);
        $enviarEmailMock = $this->createMock(EnviarEmailInterface::class);

        $controller = new CadastrarCurriculo($cadastrarMock, $enviarEmailMock);

        $requestMock = $this->createMock(CurriculoRequest::class);

        // Mock dos dados válidos para simular a validação
        $dadosValidos = [
            'nome' => 'Nome Teste',
            'email' => 'email@teste.com',
            'telefone' => '123456789',
            'cargo' => 'Desenvolvedor',
            'escolaridade' => 'ensino_medio',
            'observacoes' => '',
            'arquivo_path' => UploadedFile::fake()->create('documento.pdf', 1024),
        ];

        // Configurando o mock para o método validated() retornar os dados válidos
        $requestMock->expects($this->once())
            ->method('validated')
            ->willReturn($dadosValidos);

        // Configurando o mock para o método execute() retornar dados simulados
        $cadastrarMock->expects($this->once())
            ->method('execute')
            ->with($dadosValidos)
            ->willReturn(['id' => 1, 'nome' => 'Nome Teste']); // Dados simulados após o cadastro

        // Configurando o mock para o método enviarEmail() retornar dados simulados
        $enviarEmailMock->expects($this->once())
            ->method('enviarEmail')
            ->with(['id' => 1, 'nome' => 'Nome Teste']) // Dados simulados após o cadastro
            ->willReturn(['status' => 'success']); // Dados simulados após o envio de e-mail

        // Act
        $response = $controller->cadastrar($requestMock);

        // Assert
        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode()); // Verifica se o status HTTP é 201
        $this->assertArrayHasKey('message', $response->getData(true)); // Verifica se a resposta contém a chave 'message'
        $this->assertEquals('Candidatura enviada com sucesso', $response->getData(true)['message']); // Verifica a mensagem de sucesso
    }

    public function test_retorna_erro_quando_campos_obrigatorios_estao_ausentes()
    {
        // Arrange
        $cadastrarMock = $this->createMock(CadastrarInterface::class);
        $enviarEmailMock = $this->createMock(EnviarEmailInterface::class);

        $controller = new CadastrarCurriculo($cadastrarMock, $enviarEmailMock);

        // Mock dos dados com campos obrigatórios ausentes
        $dadosInvalidos = [
            // campos ausentes
        ];

        
        // Configurando o mock para o método validated() lançar uma exceção de validação
        $requestMock = $this->createMock(CurriculoRequest::class);
        // Configurando o mock para o método validated() lançar uma exceção de validação
        $requestMock->expects($this->once())
        ->method('validated')
        ->willThrowException(
            ValidationException::withMessages([
                'nome' => 'O campo nome é obrigatório.',
                'email' => 'O campo email é obrigatório.',
                'telefone' => 'O campo telefone é obrigatório.',
                'cargo' => 'O campo cargo é obrigatório.',
                'escolaridade' => 'O campo escolaridade é obrigatório.',
                'arquivo_path' => 'O campo arquivo é obrigatório.',
            ])
        );

        // Act
        $response = $controller->cadastrar($requestMock);

        // Assert
        $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $response->getStatusCode()); // Verifica se o status HTTP é 422
        $this->assertArrayHasKey('error', $response->getData(true)); // Verifica se a resposta contém a chave 'error'
        $this->assertArrayHasKey('details', $response->getData(true)); // Verifica se a resposta contém a chave 'details'
        $this->assertNotEmpty($response->getData(true)['details']); // Verifica se os detalhes do erro não estão vazios        
    }
}
