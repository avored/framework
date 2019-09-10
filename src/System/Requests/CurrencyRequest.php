<?php

namespace AvoRed\Framework\System\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyRequest extends FormRequest
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
        $rules['code'] = 'required';
        $rules['symbol'] = 'required';
        $rules['conversation_rate'] = 'required';
        $rules['status'] = 'required';

        return $rules;
    }
}
