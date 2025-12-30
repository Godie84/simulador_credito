<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoanRequestFormRequest extends FormRequest
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
            'document_type_id' => 'required|exists:document_types,id',
            'document_number' => 'required|numeric',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'gender' => 'required|in:M,F,O',
            'birth_date' => 'required|date|before:-18 years',
            'phone' => 'required|numeric|digits_between:10,13',
            'email' => 'required|email|max:100',
            'requested_amount' => 'required|numeric|min:100000|max:100000000',
            'number_of_installments' => 'required|integer|min:2|max:24',
        ];
    }
}
