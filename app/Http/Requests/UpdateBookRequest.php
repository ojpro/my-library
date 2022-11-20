<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class UpdateBookRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "title" => ["string", "min:5", "unique:books,title," . $this->book["id"]],
            "description" => ["string", "min:20"],
            "file" => [File::types(['pdf', 'epub', 'mobi'])->max(50 * 1024)]
        ];
    }
}
