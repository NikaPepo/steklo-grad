<form id="FormSorter" method="GET" action="{{ route('categories') }}" class="mb-4 flex gap-3">
    <select id="sorterSelect" name="parent_id" class="form-select w-64">
        <option value="">Все разделы</option>
        @foreach($categoryList->unique('id') as $category)
            @if($category)
                <option value="{{$category->id }}" @selected(request('parent_id') == $category->id)>{{$category->name . ($category->parent ? '/' . $category->parent->name : '') }}</option>
            @endif
        @endforeach
    </select>
    <input type="text" name="search" placeholder="Поиск" value="{{ request('search') }}"
           class="form-control w-64"/>
    <button class="btn btn-primary">Фильтровать</button>
    @if(request()->has('parent_id')  || request()->has('search'))
        <a href="{{ route('categories') }}" class="btn btn-secondary">Сбросить</a>
    @endif
</form>