<?php

namespace AvoRed\Framework\Promotion\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromotionCodeRequest extends FormRequest
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
        if (!isset($this->promotionCode)) {
            $rules['code'] = 'required|unique:promotion_codes';
        } else {
            $rules['code'] = 'required';
        }
        $rules['status'] = 'required';
        $rules['type'] = 'required';
        $rules['amount'] = 'required';
        $rules['active_from'] = 'nullable|date';
        $rules['active_till'] = 'nullable|date';

        return $rules;
    }
}
