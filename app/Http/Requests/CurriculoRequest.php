<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurriculoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:50', 'min:3'],
            'email' => ['required', 'email'],
            'telefone' => ['required','string', 'max:11', 'min:8'],
            'cargo' => ['required', 'string'],
            'escolaridade' => ['required', 'in:ensino_medio,cursando_ensino_superior,ensino_superior_concluido'],
            'observacoes' => ['nullable', 'string'],
            'arquivo_path' => ['required','file','mimes:doc,docx,pdf','max:1024']
        ];
    }
}
