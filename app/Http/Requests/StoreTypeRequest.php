<?php

namespace App\Http\Requests;
use Faker\Guesser\Name;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTypeRequest extends FormRequest
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
            'name' => ['required','min:5',Rule::unique('types')->ignore($this->type)],
            'color' => ['required','in:red,yellow,blue,green,pink,black'],
        ];
    }

    public function messages(){
        return[
            'required'          => 'Il campo :attribute è vuoto',
            'unique'            => 'non si possono avere due titoli uguali',
            'color.in'          => 'non è consentito cambiare il valore delle opzioni!!!',
        ];
    }
}
