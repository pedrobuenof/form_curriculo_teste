<?php

namespace App\Jobs;

use App\Mail\CurriculoEnviado;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EnviarCurriculoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $dataDb;

    public function __construct(array $dataDb)
    {
        $this->dataDb = $dataDb;
    }

    public function handle()
    {
        $emailDestino = 'devbueno3@gmail.com';
        
        $maxAttempts = 3;
        $attempts = 0;

        while ($attempts < $maxAttempts) {
            try {
                // Lógica de envio de e-mail
                Mail::to($emailDestino)->send(new CurriculoEnviado($this->dataDb));
                
                // Se chegou aqui, o e-mail foi enviado com sucesso
                break;
            } catch (\Exception $e) {
                // Log do erro
                Log::error('Job: Erro ao enviar e-mail no Job - ' . $e->getMessage());

                // Aguarde por um curto período antes de tentar novamente
                sleep(2);
                $attempts++;
            }
        }

        if ($attempts === $maxAttempts) {
            // Se atingir o número máximo de tentativas, trate conforme necessário
            Log::error('Falha ao enviar e-mail após várias tentativas no Job.');
        }

    }
}
