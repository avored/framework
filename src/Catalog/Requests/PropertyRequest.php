<?php

namespace AvoRed\Framework\Catalog\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyRequest extends FormRequest
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
        $rules['name'] = 'required|max:255';
        $rules['slug'] = 'required|max:255';
        $rules['data_type'] = 'required';
        $rules['field_type'] = 'required';
        $rules['use_for_all_products'] = 'required';
        $rules['is_visible_frontend'] = 'required';
        $rules['sort_order'] = 'required:integer';

        return $rules;
    }
}
