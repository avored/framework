<?php

namespace AvoRed\Framework\User\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserRequest extends FormRequest
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
        $validation['first_name'] = 'required|max:255';
        $validation['last_name'] = 'required|max:255';
        if ($this->getMethod() == 'POST') {
            $validation['email'] = 'required|email|max:255|unique:admin_users';
            $validation['password'] = 'required|min:6|confirmed';
        }
        return $validation;
    }
}
