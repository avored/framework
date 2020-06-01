<?php

namespace AvoRed\Framework\Catalog\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $rules['name'] = 'required';
        if (strtolower($this->method()) === 'post') {
            $rules['slug'] = 'required|unique:categories';
        } else {
            $rules['slug'] = 'required';
        }

        return $rules;
    }
}
