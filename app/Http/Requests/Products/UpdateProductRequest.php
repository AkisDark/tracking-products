<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            //
            'delivery_company' => ['nullable', 'string', 'min:1', 'max:190'],
            'name' => ['required', 'string', 'min:1', 'max:190', 'unique:products,name,' . $this->product?->id],
            'barcode' => ['required', 'string', 'between:1,50'],
            'wholesale_price' => ['nullable', 'numeric', 'min:0'],
            'retail_price' => ['nullable', 'numeric', 'min:0'],
            'weight' => ['nullable', 'numeric', 'min:0'],
            'category_id' => ['nullable', 'numeric', 'exists:categories,id'],
            'subcategory_id' => ['nullable', 'numeric', 'exists:sub_categories,id'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:4096'],
        ];
    }
}
