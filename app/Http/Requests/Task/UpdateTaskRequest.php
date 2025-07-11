<?php

namespace App\Http\Requests\Task;

use AllowDynamicProperties;
use Illuminate\Foundation\Http\FormRequest;

#[AllowDynamicProperties] class UpdateTaskRequest extends FormRequest
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
            'id' => ['required', 'int'],
            'name' => ['string', 'max:255'],
            'is_completed' => ['boolean'],
        ];
    }
}
