<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
        $rules = [
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users',
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'nullable|array|exists:roles,name',
        ];

        if ($user = $this->route('user')) {
            $rules['email'] .= ',email,' . $user->id;
        } else {
            $rules['name'] .= '|required';
            $rules['email'] .= '|required';
        }

        return $rules;
    }
}
