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
        $validationRule = [];
        $validationRule['name'] = 'required|max:255';
        if (null === $this->request->get('menu_group_id')) {
            $validationRule['identifier'] = 'required|unique:menu_groups';
        }
        return $validationRule;
    }
}
