@extends('app')

@section('page_title', 'Страничка товара')

@section('content')
    <h1 style="margin: 20px;">{{ $item->title }}</h1>

    <div style="display: flex; flex-direction: row;">
        <div style="padding: 15px; background-color: aliceblue; margin: 20px; border-radius: 15px;">
            @if (is_null($item->main_image))
                <img src="https://cdn-icons-png.flaticon.com/512/739/739249.png" alt="" style="height: 440px; border-radius: 15px;">
            @else
                <img src="{{ $item->main_image }}" alt="" style="height: 440px; border-radius: 15px;">
            @endif
            <div style="display: flex; flex-direction: column;">
                <h1 style="font-size: 40px;">{{ $item->price }} тг</h1>
                <div>
                    Тэги:
                    @foreach ($item->tags as $item_tag)
                        <a href="{{ route('tags.show', ['slug' => $item_tag->slug]) }}">{{ $item_tag->title }}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <div style="padding: 15px; background-color: aliceblue; margin: 20px; width: 100%; border-radius: 15px;">
            Категория:
            <a href="{{ route('animals.show', ['slug' => $item->animal->slug]) }}">{{ $item->animal->title }}</a>
            <br>
            Описание:
            <br>
            {{ $item->description }}
        </div>
    </div>
@endsection