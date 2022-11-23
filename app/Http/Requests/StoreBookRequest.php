<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class StoreBookRequest extends FormRequest
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
            "title" => ["required", "string", "min:5", "unique:books,title"],
            "description" => ["required", "string", "min:20"],
            "file" => ["required", File::types(['pdf', 'epub', 'mobi'])->max(50 * 1024)]
        ];
    }

    // TODO: return more user friendly messages
}
