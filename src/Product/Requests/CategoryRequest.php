<?php

namespace AvoRed\Framework\Product\Requests;

use Illuminate\Foundation\Http\FormRequest as Request;
use Illuminate\Support\Facades\Session;

class CategoryRequest extends Request
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
        
        if (Session::has('multi_language_enabled')) {

            $validationRule['default_language.name'] = 'required|max:255';
            if ($this->getMethod() == 'POST') {
                $validationRule['default_language.slug'] = 'required|max:255|alpha_dash|unique:categories';
            }
            if ($this->getMethod() == 'PUT') {
                $validationRule['default_language.slug'] = 'required|max:255|alpha_dash';
            }

            $additionalLanguages = Session::get('additionalLanguages');
            foreach ($additionalLanguages as $language) {
               
                $validationRule['additional_languages.' . $language->id . '.name'] = 'required|max:255';
                if ($this->getMethod() == 'POST') {
                    $validationRule['additional_languages.' . $language->id . '.slug'] = 'required|max:255|alpha_dash|unique:categories';
                }
                if ($this->getMethod() == 'PUT') {
                    $validationRule['additional_languages.' . $language->id . '.slug'] = 'required|max:255|alpha_dash';
                }   
            }

        } else {

            $validationRule['name'] = 'required|max:255';
            if ($this->getMethod() == 'POST') {
                $validationRule['slug'] = 'required|max:255|alpha_dash|unique:categories';
            }
            if ($this->getMethod() == 'PUT') {
                $validationRule['slug'] = 'required|max:255|alpha_dash';
            }
        }

        return $validationRule;
    }

    /**
     *
     *
     */
    public function messages()
    {
        $messages = [];

        if (Session::has('multi_language_enabled')) {

            $messages['default_language.name.required'] = 'Name Field is Required';
            $messages['default_language.name.max'] = 'The Name Field may not be greater than 255 characters';
            
            if ($this->getMethod() == 'POST') {
                
                $messages['default_language.slug.required'] = 'Slug Field is Required';
                $messages['default_language.slug.max'] = 'The Slug Field may not be greater than 255 characters';
                $messages['default_language.slug.alpha_dash'] = 'The Slug Field may only contain letters, numbers, and dashes.';
                $messages['default_language.slug.unique'] = 'The Slug has already been taken.';
            }
            if ($this->getMethod() == 'PUT') {
                $messages['default_language.slug.required'] = 'Slug Field is Required';
                $messages['default_language.slug.max'] = 'The Slug Field may not be greater than 255 characters';
                $messages['default_language.slug.alpha_dash'] = 'The Slug Field may only contain letters, numbers, and dashes.';
            }

            $additionalLanguages = Session::get('additionalLanguages');
            foreach ($additionalLanguages as $language) {
               
                $messages['additional_languages.' . $language->id . '.name.required'] = $language->name . ' name field is required';
                $messages['additional_languages.' . $language->id . '.name.max'] = $language->name . ' name field may not be greater than 255 characters';
                
                if ($this->getMethod() == 'POST') {
                    
                    $messages['additional_languages.' . $language->id . '.slug.required'] = $language->name . ' slug Field is Required';
                    $messages['additional_languages.' . $language->id . '.slug.max'] = $language->name . ' slug Field may not be greater than 255 characters';
                    $messages['additional_languages.' . $language->id . '.slug.alpha_dash'] = $language->name . ' slug field may only contain letters, numbers, and dashes.';
                    $messages['additional_languages.' . $language->id . '.slug.unique'] = $language->name . ' slug field has already been taken.';
                }
                if ($this->getMethod() == 'PUT') {
                    $messages['additional_languages.' . $language->id . '.slug.required'] = $language->name . ' slug field is Required';
                    $messages['additional_languages.' . $language->id . '.slug.max'] = $language->name . ' slug field may not be greater than 255 characters';
                    $messages['additional_languages.' . $language->id . '.slug.alpha_dash'] = $language->name . ' slug field may only contain letters, numbers, and dashes.';
                }
            }

        } else {

            $messages['name'] = 'required|max:255';
            if ($this->getMethod() == 'POST') {
                $messages['slug'] = 'required|max:255|alpha_dash|unique:categories';
            }
            if ($this->getMethod() == 'PUT') {
                $messages['slug'] = 'required|max:255|alpha_dash';
            }
        }

        return $messages;
    }
}
