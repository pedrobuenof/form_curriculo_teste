<?php

namespace App\UseCases;

use App\Http\Requests\CurriculoRequest;

interface CadastrarInterface
{
    public function execute(array $dataArray): array;
}
