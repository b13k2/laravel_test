<?php

declare(strict_types=1);

namespace App\Traits\Controllers;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait ActiveSortTrait
{
    /**
     * @param  Builder  $query
     * @return bool
     */
    private function applySort(Builder $query): bool
    {
        $sortValue = request('sort');

        $direction = Str::startsWith($sortValue, '-')
            ? 'DESC'
            : 'ASC';

        $attrName = Str::replace('-', '', $sortValue);

        $sortable = $query->getModel()->sortable ?? [];
        $isSortable = in_array($attrName, $sortable);

        if (!$isSortable) {
            return false;
        }

        $query->orderBy($attrName, $direction);
        return true;
    }
}
