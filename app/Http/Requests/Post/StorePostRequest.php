<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'name' => 'required|string',
            'canonical' => 'required|string|unique:routers',
            'post_catalogue_id' => 'gt:0'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tiêu đề',
            'canonical' => 'Đường dẫn',
            'post_catalogue_id' => 'Danh mục cha',
        ];
    }

    public function messages()
    {
        return __('request.messages');
    }
}
