<?php

namespace App\Repositories;

use App\Http\Requests\CurriculoRequest;
use App\Models\Curriculo;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Mockery\Expectation;

class Repository implements RepositoryInterface
{

    protected Curriculo $curriculo;

    public function __construct(Curriculo $curriculo)
    {
        $this->curriculo = $curriculo;
    }

    public function cadastrar(array $dataValid): ?array
    {
        try {
            
            Log::info('Repository', $_SERVER);
            Log::info('Repository antes de salvar:', $dataValid);

            $cadastrado = $this->curriculo->fill($dataValid)->save();
            // CADASTRO É UM BOOLEANO

            if(!$cadastrado){
                throw new Exception();
                return ["mensagem" => "Algo deu errado no salvamento"];
            }

            $dataDb = $this->curriculo->where('email', $dataValid['email'])->get();
            $dataDbArray = $dataDb->toArray();
            Log::info('Repositoy depois de recuperar os dados no DB:', $dataDbArray);
            
            
            return $dataDbArray;

        } catch (\Throwable $th) {
            throw new Exception($th->getMessage()); 
        }
        
    }
}
