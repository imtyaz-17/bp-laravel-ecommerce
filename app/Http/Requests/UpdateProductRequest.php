<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $product = $this->route('product');
        
        return [
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'name' => 'required|string|max:255|unique:products,name,' . $product->id,
            'description' => 'nullable|string',
            'old_price' => 'nullable|numeric|min:0',
            'new_price' => 'required|numeric|min:0',
            'is_active' => 'nullable|boolean',
        ];
    }
}
