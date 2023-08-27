<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'category_id'       => 'required|integer',
            'name'              => 'required|string',
            'slug'              => 'required|string',
            'brand'             => 'required|string',
            'small_description' => 'required|string',
            'description'       => 'required|string',
            'original_price'    => 'required|integer',
            'selling_price'     => 'required|integer',
            'quantity'          => 'nullable|integer', // Specify that quantity should be an integer
            'trending'          => 'nullable|boolean', // Use boolean validation rule for true/false values
            'status'            => 'nullable|boolean', // Use boolean validation rule for true/false values
            'meta_title'        => 'required|string',
            'meta_keyword'      => 'required|string',
            'meta_description'  => 'required|string',
            
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Adjust the 'max' value as needed
        ];
    }
}
