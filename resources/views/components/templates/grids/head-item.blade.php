@php
    declare(strict_types=1);
@endphp

@props([
    'label',
    'model',
    'attrs',
    'attrName',
])

@php
    if (!isset($label)) {
        $label = $attrs[$attrName] ?? $attrName;
    }

    $sortable = $model->sortable ?? [];
    $isSortable = in_array($attrName, $sortable);

    if ($isSortable) {
        $sortValue = request('sort');

        if ($sortValue == $attrName) {
            $sortArrow = '↑';
            $sortParams = [
                'sort' => "-$attrName",
            ];
        } elseif ($sortValue == "-$attrName") {
           $sortArrow = '↓';
           $sortParams = [
                'sort' => $attrName,
            ];
        } else {
            $sortArrow = '';
            $sortParams = [
                'sort' => $attrName,
            ];
        }

        $sortParams['page'] = null;
        $sortHref = request()->fullUrlWithQuery($sortParams);
    }
@endphp

<th>
    @if($isSortable)
        <a href="{{ $sortHref }}">{{ $label }} {{ $sortArrow }}</a>
    @else
        {{ $label }}
    @endif
</th>
