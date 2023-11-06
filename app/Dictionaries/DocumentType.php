<?php

declare(strict_types=1);

namespace App\Dictionaries;

enum DocumentType: string
{
    case arrival = '1';
    case consumption = '2';

    /**
     * @return string
     */
    public function label(): string
    {
        return match ($this) {
            DocumentType::arrival => 'Поступление',
            DocumentType::consumption => 'Расход',
        };
    }
}
