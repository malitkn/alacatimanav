<?php

namespace App\Http\Requests;

use App\Enums\PageCategoryListType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class StorePageCategoryRequest extends FormRequest
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
            'title' => ['required', 'max:150'],
            'slug' => ['required', 'max:80', 'unique:page_categories,slug'],
            'parent' => ['required',
                // 0 eşit değil ve page_categories tablosunda yok hata döndür
                function ($attribute, $value, $fail) {
                    if ($value !== "0" && !DB::table('page_categories')->where('id', $value)->exists()) {
                        $fail("Seçilen {$attribute} değeri geçersiz.");
                    }
                }
            ],
            'meta_description' => ['required', 'max:150'],
            'list_type' => ['required', Rule::enum(PageCategoryListType::class)],
        ];
    }
}
