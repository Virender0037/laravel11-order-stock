<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
         'customer_id' => ['required', 'integer', 'exists:customers,id'],
         'items' => ['required', 'array', 'min:1'],
         'items.*.product_id' => ['required', 'integer', 'exists:products,id'],
         'items.*.qty' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'items.required' => 'At least one item is required.',
            'items.array' => 'Items must be sent as an array.',
            'items.min' => 'At least one item is required.',
            'items.*.product_id.required' => 'Product is required for each item.',
            'items.*.product_id.exists' => 'Selected product does not exist.',
            'items.*.qty.required' => 'Quantity is required for each item.',
            'items.*.qty.integer' => 'Quantity must be a whole number.',
            'items.*.qty.min' => 'Quantity must be at least 1.',
        ];
    }
}
