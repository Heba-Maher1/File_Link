<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadFileRequest extends FormRequest
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
            'uploaded_file' => 'required|file|mimes:jpeg,png,pdf,docx,txt',
            'size' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:255',
        ];
    }
}
