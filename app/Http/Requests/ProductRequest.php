<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property ?Product $product
 */
abstract class ProductRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<string|Rule>>
     */
    abstract public function rules(): array;

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'vendor_code' => 'Артикул',
            'quantity' => 'Количество',
            'price' => 'Цена',
        ];
    }
}
