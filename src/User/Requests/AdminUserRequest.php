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
        $rules['first_name'] = ['required', 'string', 'max:255'];
        $rules['last_name'] = ['required', 'string', 'max:255'];
        if (strtolower($this->method()) == 'post') {
            $rules['email'] = ['required', 'string', 'email', 'max:255', 'unique:admin_users'];
            $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
        }
        $rules['role_id'] = ['required'];

        return $rules;
    }
}
