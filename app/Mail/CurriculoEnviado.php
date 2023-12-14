<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class CurriculoEnviado extends Mailable
{
    use Queueable, SerializesModels;

    public $dataDb;

    public function __construct(array $dataDb)
    {
        $this->dataDb = $dataDb;
    }

    public function build()
    {
        $arquivoPath = $this->dataDb['arquivo_path'];

        // Verifique se o arquivo existe antes de anexá-lo
        if (Storage::exists($arquivoPath)) {
            return $this->view('emails')
                ->subject('Novo Currículo Enviado')
                ->attach(
                    Storage::path($arquivoPath),
                    ['as' => 'Curriculo.pdf']
                );
        }

        return $this->view('emails')
            ->subject('Novo Currículo Enviado')
            ->withError('Arquivo não encontrado: ' . $arquivoPath);
    
    }

}
