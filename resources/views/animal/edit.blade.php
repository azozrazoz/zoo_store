@extends('app')

@section('page_title', 'Редактирование категории')

@push('local_styles')
@endpush

@section('content')
    <h1>Редактирование категории</h1>

    <form action="{{ route('animals.update', ['slug' => $animal->slug]) }}" method="POST">
        @csrf
        <div class="input_text">
            <input type="text" name="slug" value="{{ $animal->slug }}">
        </div>
        <div class="input_text">
            <input type="text" name="title" value="{{ $animal->title }}">
        </div>
        <div class="input_text">
            <input type="text" name="icon_url" value="{{ $animal->icon_url }}">
        </div>
        <div>
            <select name="is_seen" value="{{ $animal->is_seen }}">
                <option value="1">Виден</option>
                <option value="0">Не виден</option>
            </select>
        </div>
        <div>
            <input type="number" name="weight"  value="{{ $animal->weight }}">
        </div>
        <div>
            <select name="action">
                <option value="save">Сохранить</option>
                <option disabled>----</option>
                <option value="delete">Удалить</option>
            </select>
        </div>
        <div>
            <input type="submit" value="Сохранить">
        </div>
    </form>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


@endsection