@extends('app')

@section('page_title', 'Создание товара')

@push('local_styles')
    <style>
        h1 {padding: 12px;}

        form {}
        form div {padding: 12px;}
        input[type=text] {padding: 6px 12px; width: 240px;}
        input[type=number] {padding: 6px 12px; width: 240px;}
        input[type=submit] {padding: 6px 12px; width: 240px;}
        textarea {padding: 6px 12px; width: 240px;}
    </style>
@endpush

@section('content')
    <h1>Создание товара</h1>

    <form action="{{ route('items.store')}}" method="POST">
        @csrf
        <div class="input_text">
            <input type="text" name="title">
        </div>
        </div>
        <div>
            <select name="animal_id">
                <option value="" selected>Пустой</option>
                @foreach ($animals_list as $animal)
                <option value="{{ $animal->id }}">{{ $animal->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="input_text">
            <textarea name="description"></textarea>
        </div>
        <div>
            <input type="number" name="price">
        </div>
        <div>
            <input type="text" name="main_image">
        {{-- </div>
        <div>
            <select name="action">
                <option value="save">Сохранить</option>
                <option value="">----</option>
                <option value="delete">Удалить</option>
            </select>
        </div> --}}
        <div>
            <input type="submit" value="Создать">
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