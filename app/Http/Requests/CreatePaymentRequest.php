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
            'opportunity_id' => 'required|integer',
            'name' => 'required|string',
            'payment_type_id' => 'required|integer',
            'sales_stage' => 'required|string',
            'sales' => 'required|array',
            'sales.*.sale_id' => 'required|integer|exists:sales,id',
            'sales.*.amount' => 'required|numeric|min:0',
        ];
    }
}
