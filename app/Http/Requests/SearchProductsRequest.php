<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchProductsRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'categories.*' => 'nullable|exists:categories,id',
            'price'        => 'nullable|integer',
            'title'        => 'nullable|exists:properties,title',
            'value'        => 'nullable|exists:properties,value',
        ];
    }
}
