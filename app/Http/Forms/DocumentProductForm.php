<?php

declare(strict_types=1);

namespace App\Http\Forms;

use App\Http\Requests\DocumentProductRequest;

class DocumentProductForm extends DocumentProductRequest
{
    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            'product_id' => 'required|array',
            'product_id.*' => 'integer',
            'product_quantity' => 'required|array',
            'product_quantity.*' => 'integer',
        ];
    }
}
