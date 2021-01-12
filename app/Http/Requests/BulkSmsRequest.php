<?php

namespace App\Http\Requests;

use App\Rules\NoWhitespaceRule;
use Illuminate\Foundation\Http\FormRequest;

class BulkSmsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'sender' => ['required', new NoWhitespaceRule],
            'to' => 'required',
            'message' => 'required',
        ];
    }
}
