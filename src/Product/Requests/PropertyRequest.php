<?php

namespace AvoRed\Framework\Product\Requests;

use Illuminate\Foundation\Http\FormRequest as Request;
use Illuminate\Support\Facades\Session;

class PropertyRequest extends Request
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

        $multiLangFlag = Session::get('multi_language_enabled');
        $defaultLang = Session::get('default_language');
        $requestLanguageId = $this->request->get('language_id', $defaultLang->id);

        if ($requestLanguageId === $defaultLang) {
            $rules['name'] = 'required|max:255';
            $rules['sort_order'] = 'required';
            $rules['is_visible_frontend'] = 'required';
            $rules['use_for_all_products'] = 'required';
            $rules['data_type'] = 'required';
            $rules['field_type'] = 'required';
            if ($this->getMethod() == 'POST') {
                $rules['identifier'] = 'required|max:255|alpha_dash|unique:properties';
            }
            if ($this->getMethod() == 'PUT') {
                $rules['identifier'] = 'required|max:255|alpha_dash';
            }
        } else {
            $rules['name'] = 'required|max:255';
            $rules['identifier'] = 'required|max:255|alpha_dash';
        }

        return $rules;
    }
}
