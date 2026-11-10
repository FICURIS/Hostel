<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'login' =>['required', 'string', 'min:6', 'regex:/^[a-zA-Z0-0]+$/', 'unique:users'],
            'password' =>['required', 'string', 'min:8'],
            'name' =>['required', 'string', 'regex:/^[А-Яа-яЁё\s]+$/u'],
            'phone' => ['required', 'string', 'regex:/^8\(\d{3}\)\d{3}-\d{2}-\d{2}$/'],
            'email' =>['required', 'string', 'email', 'unique:users'],
        ];
    }

    public function messages(): array
    {
        return [
            'login.required' => 'Пожалуйста, введите логин',
            'password.required' => 'Пожалуйста, введите пароль',
            'name.required' => 'Пожалуйста, введите ваше полное имя',
            'phone.required' => 'Пожалуйста, введите номер телефона',
            'email.required' => 'Пожалуйста, введите Email',
            'login.min' => 'Логин должен быть не менее 6 символов',
            'password.min' => 'Пароль должен быть не менее 8 символов',
            'email.email' => 'Неверный формат Email',
            'name.regex' => 'ФИО должно содержать толко кириллицу и пробелы',
            'phone.regex' => 'Телефон должен быть в формате 8(XXX)XXX-XX-XX',
            'login.unique' => 'Такой логин уже существует',
            'email.unique' => 'Этот email уже зарегестрирован'
        ];
    }
}
