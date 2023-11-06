<?php

declare(strict_types=1);

namespace App\Http\Forms;

use App\Dictionaries\DocumentType;
use App\Http\Requests\DocumentRequest;
use Illuminate\Validation\Rule;

class DocumentForm extends DocumentRequest
{
    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            'date' => 'nullable|date',
            'type_id' => [
                'required',
                'string',
                Rule::enum(DocumentType::class),
            ],
        ];
    }
}
