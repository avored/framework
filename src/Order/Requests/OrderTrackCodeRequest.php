<?php

namespace AvoRed\Framework\Order\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderTrackCodeRequest extends FormRequest
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
        $rules['track_code'] = 'required|max:255';

        return $rules;
    }
}
