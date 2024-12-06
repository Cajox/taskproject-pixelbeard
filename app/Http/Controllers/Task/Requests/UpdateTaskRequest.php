<?php

namespace App\Http\Controllers\Task\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'title'       => ['nullable', 'string', 'max:255', 'required_without_all:description,completed'],
            'description' => ['nullable', 'string', 'required_without_all:title,completed'],
            'completed'   => ['nullable', 'boolean', 'required_without_all:title,description'],
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'title.string'       => 'The title must be a string.',
            'title.max'          => 'The title must not exceed 255 characters.',
            'description.string' => 'The description must be a string.',
            'completed.boolean'  => 'The completed field must be true or false.',
        ];
    }
}
