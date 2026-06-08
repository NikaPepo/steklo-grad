<form id="FormSorter" method="GET" action="{{ route('options') }}" class="mb-4 flex gap-3">
    <input type="text" name="search" placeholder="Поиск" value="{{ request('search') }}"
           class="form-control w-64"/>
    <button class="btn btn-primary">Фильтровать</button>
    @if(request()->has('search'))
        <a href="{{ route('options') }}" class="btn btn-secondary">Сбросить</a>
    @endif
</form>