@extends('app')

@section('page_title', 'Список всех товаров')

@push('local_styles')
@endpush


@section('content')
    <h1>Список всех товаров</h1>

    @foreach ($items as $item)
        <div style="display: flex; flex-direction: row;
        align-items: center; padding: 12px; border-bottom: 1px dashed rgb(98, 98, 98);">
            <div style="width: 750px">
                {{ $item->title }}
            </div>
            <form method="post" action="{{ route('items.update_animal', [ 'slug' => $item->slug ]) }}">
                @csrf
                <select name="animal_id">
                    <option value="" @if($item->animal_id == "") selected @endif>Без категории</option>
                    @foreach ($animals as $animal)
                    <option value="{{ $animal->id }}" @if($item->animal_id == $animal->id) selected @endif>
                        {{ $animal->title }}
                    </option>
                    @endforeach
                </select>
                <input type="submit" value="Изменить">
            </form>
        </div>
    @endforeach
@endsection

