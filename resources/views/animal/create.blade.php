@extends('app')

@section('page_title', 'Создание категории')

@push('local_styles')
@endpush

@section('content')
    <h1>Создание категории</h1>

    <form action="{{ route('animals.store') }}" method="POST">
        @csrf
        <div class="input_text">
            <input type="text" name="slug">
        </div>
        <div class="input_text">
            <input type="text" name="title">
        </div>
        <div class="input_text">
            <input type="text" name="icon_url">
        </div>
        <div>
            <select name="is_seen"">
                <option value="1" selected>Виден</option>
                <option value="0">Не виден</option>
            </select>
        </div>
        <div>
            <input type="number" name="weight">
        </div>
        <div>
            <select name="action">
                <option value="save" selected>Сохранить</option>
                <option value="">----</option>
                <option value="delete">Удалить</option>
            </select>
        </div>
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