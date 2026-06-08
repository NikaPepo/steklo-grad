<form id="FormSorter" method="GET" action="{{ route('products') }}" class="mb-4 flex gap-3">
    <select  name="category_id" class="form-select w-64">
        <option value="">Все разделы</option>
        @foreach($productWithCategoryList->map->category->unique('id') as $category)
                <option value="{{$category->id }}" @selected(request('category_id') == $category->id)>{{$category->name . ($category->parent ? '/' . $category->parent?->name : '') }}</option>
        @endforeach
    </select>
    <input type="text" name="search" placeholder="Поиск" value="{{ request('search') }}"
           class="form-control w-64"/>
    <button class="btn btn-primary">Фильтровать</button>
    @if(request()->has('category_id')  || request()->has('search'))
        <a href="{{ route('products') }}" class="btn btn-secondary">Сбросить</a>
    @endif
</form>