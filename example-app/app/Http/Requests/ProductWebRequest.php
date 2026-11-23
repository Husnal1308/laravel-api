<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductWebRequest extends FormRequest
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
            'nama'        => ['required', 'string', 'max:255'],
            // saat edit, SKU milik produk itu sendiri tidak dianggap kembar
            'sku'         => ['required', 'string', 'max:20',
                              Rule::unique('products', 'sku')
                                  ->ignore($this->route('produk'))
                                  ->whereNull('deleted_at')],
            'category_id' => ['required', 'exists:categories,id'],
            'harga'       => ['required', 'integer', 'min:0'],
            'stok'        => ['required', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required'        => 'Nama produk wajib diisi.',
            'sku.required'         => 'SKU wajib diisi.',
            'sku.unique'           => 'SKU sudah dipakai.',
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists'   => 'Kategori yang dipilih tidak valid.',
            'harga.required'       => 'Harga wajib diisi.',
            'harga.integer'        => 'Harga harus berupa angka bulat.',
            'harga.min'            => 'Harga tidak boleh negatif.',
            'stok.required'        => 'Stok wajib diisi.',
            'stok.integer'         => 'Stok harus berupa angka bulat.',
            'stok.min'             => 'Stok tidak boleh negatif.',
        ];
    }
}
