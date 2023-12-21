<?php

namespace App\Repositories;

use App\Http\Requests\CurriculoRequest;
use App\Models\Curriculo;
use Exception;
use Illuminate\Database\QueryException;
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
            
            //Log::info('Repository', $_SERVER);
            //Log::info('Repository antes de salvar:', $dataValid);

            $cadastrado = $this->curriculo->fill($dataValid)->save();
            // CADASTRO É UM BOOLEANO

            if(!$cadastrado){
                throw new QueryException("Erro ao cadastrar no banco de dados");               
            }

            $dataDb = $this->curriculo->where('email', $dataValid['email'])->get();

            if (!$dataDb) {
                throw new QueryException("Erro ao resgatar registro no banco de dados");
            }

            $dataDbArray = $dataDb->toArray();
            //Log::info('Repositoy depois de recuperar os dados no DB:', $dataDbArray);
                       
            return $dataDbArray;

        } catch (QueryException $queryException) {
            Log::error('Repository: Erro ao cadastrar ou resgatar no repositório - ', ['message' => $queryException->getMessage()]);

            return ["erro" => "Respository: Erro no banco de dados - ", "mensagem" => $queryException->getMessage()];
        } catch (\Exception $e) {
            Log::error('Repository: Erro desconhecido ao cadastrar no repositório - ', ['message' => $e->getMessage()]);

            return ["erro" => "Repository: Ocorreu um erro ao cadastrar no DB - ", "mensagem" => $e->getMessage()];
        }
        
    }
}
