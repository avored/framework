<?php

namespace AvoRed\Framework\Cms\Requests;

use Illuminate\Foundation\Http\FormRequest as Request;

class MenuGroupRequest extends Request
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
        $rules['identifier'] = 'required|max:255';

        return $rules;
    }
}
