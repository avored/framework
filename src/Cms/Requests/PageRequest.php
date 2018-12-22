<?php

namespace AvoRed\Framework\Cms\Requests;

use Illuminate\Foundation\Http\FormRequest as Request;

class PageRequest extends Request
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
        $validationRule = [];
        $validationRule['name'] = 'required|max:255';
        $validationRule['content'] = 'required';
        $validationRule['slug'] = 'required|max:255|alpha_dash';

        if ($this->getMethod() == 'POST') {
            $validationRule['slug'] .= '|unique:pages';
        }

        return $validationRule;
    }
}
