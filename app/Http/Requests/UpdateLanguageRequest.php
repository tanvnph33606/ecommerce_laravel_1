<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLanguageRequest extends FormRequest
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
            'canonical' => 'required|string|unique:languages,canonical,' . $this->id,

        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên ngôn ngữ',
            'canonical' => 'Canonical',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute bắt buộc nhập.',
            'unique' => ':attribute đã tồn tại.',
            'email' => ':attribute sai định dạng.',
            'string' => ':attribute phải là dạng ký tự.',
            'integer' => ':attribute phải là dạng số.',
            'email' => ':attribute sai định dạng.',
            'min' => ':attribute phải tối thiểu :min ký tự.',
            'same' => ':attribute chưa khớp.',
            'gt' => ':attribute phải lớn hơn 0.',
        ];
    }
}
