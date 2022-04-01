<?php

namespace App\Http\Requests\Auth;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LoginRequest extends FormRequest
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
        return [
            'login' => 'required',
            'password'=>'required'
        ];
    }

    public function messages(): array
    {
        return [
            'login.required' => 'Поле <:attribute> обязательно для заполнения',
            'password.required' => 'Поле <:attribute> обязательно для заполнения',
        ];
    }


}
