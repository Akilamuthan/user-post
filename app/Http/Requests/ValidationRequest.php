<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidationRequest extends FormRequest
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
            "post_type" => "required|string|max:255",
            "title" => "required|string|max:255",
            "content" => "required|string|max:255",
            "description" => "required|string|max:255",
            "file_path" => "required|file", 
            "file_type" => "required|string|max:255",
            "status" => "required|string|max:255",
            "category_id" => "required|string",
            "tag_id" => "required|array", 
        ];
    }
}
