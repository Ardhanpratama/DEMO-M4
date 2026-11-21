<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMediaRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('media', 'title')->where(
                    fn ($query) => $query->where('type', $this->input('type'))
                ),
            ],
            'type' => ['required', 'string', 'max:50'],
            'genre' => ['required', 'string', 'max:100'],
            'release_year' => ['nullable', 'integer', 'digits:4', 'min:1900', 'max:' . (int) date('Y')],
            'vibe' => ['nullable', 'string', 'max:100'],
            'cover_url' => ['nullable', 'url', 'max:2048'],
        ];
    }
}
