<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProjectRequest extends FormRequest
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
            'title'             => ['required', 'min:10', Rule::unique('projects')->ignore($this->project)],
            'description'       => ['nullable', 'min:20'],
            'type_id'           => ['nullable', 'exists:types,id'],
            'cover_image'       => ['nullable', 'image', 'mimes: jpeg,jpg', 'max:2048'],
        ];
    }

    public function messages()
    {
        return [
            'required'          => 'Il campo :attribute è vuoto',
            'min'               => 'Titolo: devi inserire un minimo di :min caratteri',
            'unique'            => 'non si possono avere due titoli uguali',
            'description.min'   => 'Descrizione: devi inserire un minimo di 20 caratteri',
            'type_id'           => 'l\'id non esiste',
            'cover_image.image' => 'deve essere una foto',
            'cover_image.mimes' => 'formato consentito jpg o jpeg',
            'cover_image.max'   => 'dimensione massima 2 mb',
        ];
    }
}
