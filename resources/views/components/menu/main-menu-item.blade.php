@props([
    'label',
    'url',
    'icon' => '',
    'active' => false,
])

<div class="menu-item">
    <a class="{{ $active ? 'menu-link active' : 'menu-link' }}" href="{{ $url }}">
        <span class="menu-icon">
            <span class="{{ $icon ?: 'fa fa-circle-thin' }}"></span>
        </span>
        <span class="menu-title">{{ $label }}</span>
    </a>
</div>
