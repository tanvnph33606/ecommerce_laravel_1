<?php

namespace App\Http\Requests\{ModuleTemplate};

use App\Rules\Check{ModuleTemplate}ChildrenRule;
use Illuminate\Foundation\Http\FormRequest;

class Delete{ModuleTemplate}Request extends FormRequest
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
        $_id = request('_id');
        return [
            '_id' => [
                new Check{ModuleTemplate}ChildrenRule($_id),
            ]
        ];
    }
}
