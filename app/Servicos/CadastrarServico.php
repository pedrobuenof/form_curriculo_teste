<?php

namespace App\Servicos;

use App\Repositories\RepositoryInterface;
use App\UseCases\CadastrarInterface;
use Exception;
use Illuminate\Support\Arr;
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

            //Log::info('Serviço antes do tratamento:', $dataArray);
            Arr::forget($dataArray, '_token');
            $dataArray['arquivo_path'] = $dataArray['arquivo_path']->store('curriculo');
            $dataArray['ip'] = $_SERVER['REMOTE_ADDR'];
            //Log::info('Serviço pós tratamento:', $dataArray);

            $dataDb = $this->repository->cadastrar($dataArray);
            //Log::info('Serviço depois de enviar os dados para cadastro:', $dataDb);
            if (isset($dataDb['erro'])) {
                throw new Exception($dataDb['mensagem']);
            }

            return $dataDb;

        } catch (\Exception $e) {

            Log::error('Serviço: Erro ao cadastrar - ', ['message' => $e->getMessage()]);

            return ["erro" => "Serviço: Ocorreu um erro ao cadastrar - ", "mensagem" => $e->getMessage()];
        }
        
    }
};
