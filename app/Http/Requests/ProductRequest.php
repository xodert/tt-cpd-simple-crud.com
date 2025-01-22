<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        if ($this->has('article')) {
            return $this->canEditArticle();
        }

        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|min:10',
            'status' => 'required|in:available,unavailable',
            'data' => 'required|array',
            'data.price' => 'required|numeric|min:0',
            'data.size' => 'required|string'
        ];

        if ($this->isMethod('post') || $this->has('article')) {
            $rules['article'] = 'required|alpha_num|unique:products,article' .
                ($this->product ? ',' . $this->product->id : '');
        }

        return $rules;
    }

    /**
     * Check if user can edit article field.
     *
     * @return bool
     */
    private function canEditArticle(): bool
    {
        return Auth::check() && in_array(
            Auth::user()->role,
            config('roles.can-edit-articles', [])
        );
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The product name is required.',
            'name.min' => 'The product name must be at least 10 characters.',
            'article.required' => 'The article is required.',
            'article.alpha_num' => 'The article may only contain letters and numbers.',
            'article.unique' => 'This article has already been taken.',
            'data.price.required' => 'The price is required.',
            'data.price.numeric' => 'The price must be a number.',
            'data.price.min' => 'The price must be at least 0.',
            'data.size.required' => 'The size is required.',
        ];
    }
}
