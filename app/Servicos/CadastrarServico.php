<?php

namespace App\Servicos;

use App\Http\Requests\CurriculoRequest;
use App\Repositories\RepositoryInterface;
use App\UseCases\CadastrarInterface;
use Exception;
use Illuminate\Support\Facades\Log;

class CadastrarServico implements CadastrarInterface
{

    protected RepositoryInterface $repository;
    

    public function __construct(RepositoryInterface $repository,)
    {
        $this->repository = $repository;

        
    }

    public function execute(array $dataArray): array
    {   
        try {  

            Log::info('Serviço antes do tratamento:', $dataArray);
            $dataArray['arquivo_path'] = $dataArray['arquivo_path']->store('curriculo');
            $dataArray['ip'] = $_SERVER['REMOTE_ADDR'];
            Log::info('Serviço pós tratamento:', $dataArray);

            $dataDb = $this->repository->cadastrar($dataArray);
            Log::info('Serviço depois de enviar os dados para cadastro:', $dataDb);
            if($dataDb['mensagem']){
                throw new Exception();
            }

            return $dataDb;

        } catch (\Throwable $th) {
            Log::error('Erro ao cadastrar', ['message' => $th->getMessage()]);
            return ["erro" => "Ocorreu um erro ao cadastrar", "mensagem" => $th->getMessage()];
        }
        
    }
};
