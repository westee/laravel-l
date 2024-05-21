<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

use Illuminate\Http\Exceptions\HttpResponseException;
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        // 你可以在这里进行自定义的重定向逻辑
        // 例如，重定向回之前的页面并带上错误消息
        $errors = $validator->errors();

        $response = response()->json([
            'message' => 'Validation Failed',
            'errors' => $errors,
        ], 422);

        throw new HttpResponseException($response);
    }
}
