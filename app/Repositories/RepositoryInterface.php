<?php

namespace App\Repositories;

use App\Http\Requests\CurriculoRequest;

interface RepositoryInterface
{
    public function cadastrar(array $dataValid): ?array;
}
