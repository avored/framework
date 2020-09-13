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
        $rules['type'] = 'required|max:255';
        $rules['route_info'] = 'required|max:255';
        $rules['sort_order'] = 'required|max:255';
      

        return $rules;
    }
}
