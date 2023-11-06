<?php

declare(strict_types=1);

namespace App\Http\Search;

use App\Http\Requests\ProductRequest;

class ProductSearch extends ProductRequest
{
    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            'id' => 'nullable|int',
            'name' => 'nullable|string|max:100',
            'vendor_code' => 'nullable|string|max:100',
        ];
    }
}
