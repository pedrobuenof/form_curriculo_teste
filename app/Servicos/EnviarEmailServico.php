<?php

namespace App\Servicos;

use App\Jobs\EnviarCurriculoJob;
use App\UseCases\EnviarEmailInterface;
use Illuminate\Support\Facades\Log;


class EnviarEmailServico implements EnviarEmailInterface
{
    public function enviarEmail(array $dataDb): array
    {
        
        try {
            
            Log::info('Email serviço:', $dataDb[0]);
            // Enfileirar o Job para envio de e-mail
            EnviarCurriculoJob::dispatch($dataDb[0]);

            
            return ['status' => 'success', 'message' => 'E-mail enfileirado para envio.'];

        } catch (\Exception $e) {

            Log::error('Erro ao enfileirar Job de e-mail: ' . $e->getMessage());
            return ['status' => 'error', 'message' => 'Erro ao enfileirar Job de e-mail. Consulte os logs para obter mais detalhes.'];

        }

    }
}
