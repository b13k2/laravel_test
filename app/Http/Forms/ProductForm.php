<?php

declare(strict_types=1);

namespace App\Http\Forms;

use App\Http\Requests\ProductRequest;
use Illuminate\Validation\Rule;

class ProductForm extends ProductRequest
{
    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:100',
            'quantity' => 'required|int',
            'price' => 'required|decimal:0,2',
        ];

        $vendorCodeRules = [
            $this->product ? 'nullable' : 'required',
            'string',
            'max:100',
            Rule::unique('products')->ignore($this->product),
        ];

        if ($this->product) {
            $vendorCodeRules[] = 'exists:products,vendor_code';
        }

        $rules['vendor_code'] = $vendorCodeRules;
        return $rules;
    }
}
