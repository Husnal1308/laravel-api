<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'nama' => ['required','string','max:255'],
        'sku' => ['nullable','string','max:20',
        'unique:products,sku'],
        'harga' => ['required','integer','min:0'],
        'kategori' => ['nullable','string','max:255'],
        'category_id' => ['nullable','exists:categories,id'],
        ];
    }

    public function messages(): array
{ return [
  'nama.required' => 'Nama produk wajib diisi.',
  'harga.min' => 'Harga tidak boleh negatif.',
  'sku.unique' => 'SKU sudah dipakai.',
]; }
}
