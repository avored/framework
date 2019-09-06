<?php

namespace AvoRed\Framework\Cms\Requests;

use Illuminate\Foundation\Http\FormRequest as Request;

class MenuRequest extends Request
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
        $rules = [];
        $rules['name'] = 'required|max:255';
        if ($this->method() === 'post') {
            $rules['identifier'] = 'required|max:255|unique:menu_groups';
        } else {
            $rules['identifier'] = 'required|max:255';
        }

        return $rules;
    }
}
