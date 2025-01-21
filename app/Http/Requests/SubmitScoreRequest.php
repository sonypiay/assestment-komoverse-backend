<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitScoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'string'],
            'score' => ['required', 'numeric'],
            'level' => ['required', 'numeric']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'user_id.required' => 'A user id must required',
            'user_id.string' => 'User id must be a string',
            'score.required' => 'Score must required',
            'score.numeric' => 'Score must be a numeric',
            'level.required' => 'Level must required',
            'level.numeric' => 'Level must be a numeric'
        ];
    }
}
