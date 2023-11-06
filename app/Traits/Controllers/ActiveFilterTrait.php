<?php

declare(strict_types=1);

namespace App\Traits\Controllers;

use Illuminate\Contracts\Database\Eloquent\Builder;

trait ActiveFilterTrait
{
    private function applyFilter(Builder $query, string $attrName, string $fieldType): void
    {
        $sortable = $query->getModel()->sortable ?? [];
        $isFilterable = in_array($attrName, $sortable);

        if (!$isFilterable) {
            return;
        }

        $attrValue = request($attrName);

        if ($attrValue === null) {
            return;
        }

        switch ($fieldType) {
            case 'int':
                $attrValue = intval($attrValue);
                if ($attrValue) {
                    $query->where($attrName, '=', $attrValue);
                }
                break;

            case 'string':
                $attrValue = trim(strval($attrValue));
                if ($attrValue) {
                    $query->where($attrName, 'LIKE', "%$attrValue%");
                }
                break;

            case 'select':
                if ($attrValue) {
                    if (!is_array($attrValue)) {
                        $attrValue = [$attrValue];
                    }

                    $query->whereIn($attrName, $attrValue);
                }
                break;

            case 'date':
                $attrValue = trim(strval($attrValue));
                if ($attrValue) {
                    $query->whereDate($attrName, '=', $attrValue);
                }
                break;

            case 'bool':
            case 'isActive':
                $attrValue = filter_var($attrValue, FILTER_VALIDATE_BOOL, FILTER_NULL_ON_FAILURE);
                if ($attrValue !== null) {
                    $query->where($attrName, '=', $attrValue);
                }
                break;
        }
    }
}
