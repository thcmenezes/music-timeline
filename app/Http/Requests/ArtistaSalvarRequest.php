<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArtistaSalvarRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        
        return [
            'nome' => 'required'
        ];
    }

    public function messages() {
        return [
            'nome.required' => 'Informe o nome do artista ou da banda.'
        ];
    }
}
