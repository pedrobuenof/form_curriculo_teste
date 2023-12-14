<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculo extends Model
{
    use HasFactory;

    protected $table = 'curriculos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'cargo',
        'escolaridade',
        'observacoes',
        'arquivo_path',
        'ip'
    ];
}
