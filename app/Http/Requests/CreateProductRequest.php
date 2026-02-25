<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
        'sku' => ['required', 'string', 'max:25'],
        'name' => ['required', 'string', 'max:255', 'unique:products,name'],
        'price' => ['required', 'numeric'],
        'stock' => ['required', 'integer'],
        'status' => ['required', 'in:active,inactive'],
        ];
    }
}
