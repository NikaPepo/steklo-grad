@props(['field', 'label', 'sort' => null, 'direction' => null ])
@php
    $isActive =  $sort === $field;
    $nextDirection = ($isActive && $direction === 'asc') ? 'desc' : 'asc';
    $url = request()->fullUrlWithQuery(
        [
            'sort' => $field,
            'direction' => $nextDirection
    ]
    );
@endphp
<a href="{{$url}}" class="flex items-center gap-1 whitespace-nowrap hover:underline">
    <span>{{$label}}</span>
    @if($isActive)
        @if($direction === 'asc')
            <i class="bx bx-chevron-up text-primary"></i>
        @else
            <i class="bx bx-chevron-down text-primary"></i>
        @endif
    @else
        <i class="bx bx-sort text-muted"></i>
    @endif
</a>
