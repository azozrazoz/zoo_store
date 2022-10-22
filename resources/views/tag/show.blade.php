@extends('app')

@section('page_title', 'Коты и Хвосты | Главная')

@push('local_styles')
    <style>
        .main_nav {display: flex; flex-direction: row; justify-content: space-around; background-color: white; height: 130px; max-width: 1024px;}
        .nav_single {margin: 20px; padding: 16px; justify-content: center; text-align: center; border-radius: 15px; background-color: rgba(255, 203, 203, 0.5);}
        a {color: rgb(0, 0, 0); text-decoration: none; align-content: center; text-align: center;}
        a:hover {color: rgb(67, 145, 205); text-decoration: underline;}
            .icon {height: 45px;}
            .icon img {height: 45px;}
        nav.tag__nav { background-color: white; border-radius: 6px; max-width: 1024px; padding: 10px 0px 10px 0px; margin-bottom: 30px;}
        nav.tag__nav ol { list-style-type: none; padding: 10px;}
        nav.tag__nav ol li { padding: 6px;}
        .items a:hover {color: white; text-decoration: none;}
    </style>
@endpush

@section('content')
    <div class="main_nav">
        @foreach ($animals_list as $animal)
            <div class="nav_single">
                <div class="icon">
                    <img src="{{ $animal->icon_url }}" alt="{{ $animal->slug }}">
                </div>
                <div>
                    <a href="{{ route('animals.show', ['slug' => $animal->slug]) }}">{{ $animal->title }}</a>
                </div>
            </div>
        @endforeach
        <div class="nav_single">
            <div class="icon">
                <img src="https://cdn-icons-png.flaticon.com/512/687/687529.png" alt="Аптека">
            </div>
            <div>
                <a href="{{ route('hospital') }}">Аптека</a>
            </div>
        </div>
    
        <div class="nav_single">
            <div class="icon">
                <img src="https://cdn-icons-png.flaticon.com/512/879/879757.png" alt="Акции">
            </div>
            <div>
                <a href="{{ route('stocks') }}">Акции</a>
            </div>
        </div>
    </div>
    
    <div style="display: flex; flex-direction: column; margin: 20px 0px;">
        <nav style="width: 100%" class="tag__nav">
            <h3 style="padding: 15px 0px 0px 15px; ">Тэги:</h3>
            <ol style="flex-direction: row; display: flex;">
                @foreach($tags as $tag)
                    <li><a href="{{ route('tags.show', ['slug'=>$tag->slug]) }}">{{ $tag->title }}</a></li>
                @endforeach
            </ol>
        </nav>

        <div style="position: relative;" class="items">

            <img src="https://images03.nicepage.io/a1389d7bc73adea1e1c1fb7e/45ff09452d05581491e31e57/pexelsphoto3782766.jpeg" alt="" 
            style="width: 100%; opacity: 0.5; position: absolute;">


            <div style="width: 100%; display: flex; flex-diraction: row; flex-wrap: wrap; position: absolute;">
                @foreach ($items_list as $item)
                <a href="{{ route('items.show', ['slug' => $item->slug ]) }}" style="width: 25%;">
                    <div
                    style="display: flex; justify-content: center; padding: 8px; flex-direction: column; aligh-items: center; 
                    background-color: #bda0a079; border: 1px solid rgb(235, 223, 223)">
                    
                        @if (is_null($item->main_image))
                            <img src="https://cdn-icons-png.flaticon.com/512/739/739249.png" alt="">
                        @else
                            <img src="{{ $item->main_image }}" alt="">
                        @endif
                        <div>
                            @if (strlen($item->title) > 30)
                                <h4>{{ substr($item->title, 0, 30) . "..." }}</h4>
                            @else
                                <h4>{{ $item->title }}</h4>
                            @endif
                            {{ $item->price }} тг
                        </div>
                    </div>
                </a>    
                @endforeach
            </div>
        </div>
    </div>

@endsection