@if($breadcrumbs)
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">
                Главная
            </a>
        </li>

        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>

        @foreach($breadcrumbs as $item)
            @if(is_array($item))
                <li class="breadcrumb-item">
                    <a href="{{ $item['url'] }}" class="text-muted text-hover-primary">
                        {{ $item['label'] }}
                    </a>
                </li>
            @else
                <li class="breadcrumb-item text-muted">{{ $item }}</li>
            @endif

            @if(!$loop->last)
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
            @endif
        @endforeach
    </ul>
@endif
