<?php

declare(strict_types=1);

namespace App\Http\Search;

use App\Dictionaries\DocumentType;
use App\Http\Requests\DocumentRequest;
use Illuminate\Validation\Rule;

class DocumentSearch extends DocumentRequest
{
    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            'date' => 'nullable|date',
            'type_id' => [
                'nullable',
                'string',
                Rule::enum(DocumentType::class),
            ],
        ];
    }
}
