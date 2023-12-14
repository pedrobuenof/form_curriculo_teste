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
        
        // Lógica de envio de e-mail
        Mail::to($emailDestino)->send(new CurriculoEnviado($this->dataDb));

    }
}
