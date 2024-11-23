<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
            'name' => 'required',
            'value' => 'required|max:10',
            'due_date' => 'required',
            'status_account_id' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Campo nome é obrigatório',
            'value.required' => 'Campo valor é obrigatório',
            'value.max' => 'Campo valor deve ter no máximo 8 digitos',
            'due_date.required' => 'Campo vencimento é obrigatório',
            'status_account_id.required' => 'Campo situação da conta é obrigatório',
        ];
    }
}