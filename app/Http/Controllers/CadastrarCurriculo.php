<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurriculoRequest;
use App\UseCases\CadastrarInterface;
use App\UseCases\EnviarEmailInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
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

            Log::info('Controller antes do cadastro e com token:', $dataValid);
            Arr::forget($dataValid, '_token');
            Log::info('Controller antes do cadastro e sem token:', $dataValid);

            $dataDb = $this->cadastrar->execute($dataValid);
            Log::info('Controller pós cadastro:', $dataDb);
            
            if($dataDb['erro']){
                throw new Exception();
            }
            

            $result = $this->enviarEmail->enviarEmail($dataDb);
            Log::info('Controller pós envio de email:', $result);

            if($result['status'] == 'error'){
                throw new Exception();
            }

            return response()->json(['message' => 'Candidatura enviada com sucesso'], Response::HTTP_CREATED);

        } catch (\Exception $e) {
            return response()->json(['message' => "deu errado1: " . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        
    }
}
