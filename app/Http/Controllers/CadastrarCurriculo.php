<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurriculoRequest;
use App\UseCases\CadastrarInterface;
use App\UseCases\EnviarEmailInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class CadastrarCurriculo extends Controller
{
    protected CadastrarInterface $cadastrar;
    protected EnviarEmailInterface $enviarEmail;

    public function __construct(CadastrarInterface $cadastrar, EnviarEmailInterface $enviarEmail)
    {
        $this->cadastrar = $cadastrar;

        $this->enviarEmail = $enviarEmail;
    }

    public function cadastrar(CurriculoRequest $request)
    {
        try {
            
            $dataValid = $request->validated();
            //Log::info('Controller antes do cadastro e com token:', $dataValid);

            $dataDb = $this->cadastrar->execute($dataValid);
            //Log::info('Controller pós cadastro:', $dataDb);
            
            if (isset($dataDb['erro'])) {
                Log::error('controller erro cadastrar:', $dataDb);
                return response()->json(['message' => 'Erro ao cadastrar o currículo', 'error_details' => $dataDb], Response::HTTP_BAD_REQUEST);
            }        

            $result = $this->enviarEmail->enviarEmail($dataDb);
            //Log::info('Controller pós envio de email:', $result);

            if($result['status'] == 'error'){
                Log::error('controller erro enviar e-mail:', $result);
                return response()->json(['message' => 'Erro ao enviar e-mail', 'error_details' => $result], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            return response()->json(['message' => 'Candidatura enviada com sucesso'], Response::HTTP_CREATED);

        } catch (\Throwable $th) {
            Log::error('Erro ao cadastrar currículo', ['message' => $th->getMessage(), 'trace' => $th->getTraceAsString()]);

            return response()->json(['message' => 'Ocorreu um erro ao processar a solicitação'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        
    }
}
