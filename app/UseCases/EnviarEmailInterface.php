<?php

namespace App\UseCases;

interface EnviarEmailInterface
{
     public function enviarEmail(array $dataDb): array;
}
