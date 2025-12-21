<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePaymentRequest extends FormRequest
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
            'name' => 'required|string',
            'payment_type_id' => 'required|integer',
            'sales_stage' => 'nullable|string',
            'amount' => 'nullable|numeric|min:0',
            'sale_id' => 'nullable|integer|exists:sales,id',
            'sales' => 'nullable|array',
            'sales.*.company_id' => 'nullable|integer',
            'sales.*.amount' => 'nullable|numeric|min:0',
        ];
    }
}
