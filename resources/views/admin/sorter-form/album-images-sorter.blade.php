<form id="FormSorter" method="GET" action="{{ route('album-images') }}" class="mb-4 flex gap-3">
    <select  name="album_id" class="form-select w-64">
        <option value="">Все разделы</option>
        @foreach($albumImagesList->map->album->unique('id') as $album)
            <option value="{{$album->id }}" @selected(request('album_id') == $album->id)>{{$album->name}}</option>
        @endforeach
    </select>
    <input type="text" name="search" placeholder="Поиск" value="{{ request('search') }}"
           class="form-control w-64"/>
    <button class="btn btn-primary">Фильтровать</button>
    @if(request()->has('album_id')  || request()->has('search'))
        <a href="{{ route('album-images') }}" class="btn btn-secondary">Сбросить</a>
    @endif
</form>