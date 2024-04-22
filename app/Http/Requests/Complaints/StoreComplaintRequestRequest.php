<?php

namespace App\Http\Requests\Complaints;

use Illuminate\Foundation\Http\FormRequest;

class StoreComplaintRequestRequest extends FormRequest
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
            'product_id' => ['required', 'numeric', 'exists:products,id'],
            'name' => ['nullable', 'string', 'min:1', 'max:190'],
            'email' => ['nullable', 'email', 'min:1', 'max:190'],
            'phone' => ['nullable', 'numeric', 'starts_with:05,06,07', 'digits:10'],
            'state_id' => ['required', 'numeric', 'exists:states,id'],
            'city_id' => ['required',  'numeric', 'exists:cities,id'],
            'message' => ['required', 'string', 'min:1', 'max:1000']

        ];
    }
}
