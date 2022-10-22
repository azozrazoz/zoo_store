@extends('app') 

@section('page_title', 'Результат поиска')

@push('local_styles')
<style>
    .main_nav {display: flex; flex-direction: row; justify-content: space-around; background-color: white; height: 130px;}
    .nav_single {margin: 20px; padding: 16px; justify-content: center; text-align: center;}
        .icon {height: 36px;}
        .icon img {height: 36px;}
        a {color: rgb(0, 0, 0); text-decoration: none; align-content: center; text-align: center;}
        a:hover {color: rgb(153, 211, 255); text-decoration: underline;}
            .icon {height: 36px;}
            .icon img {height: 36px;}
            .items a:hover {color: white; text-decoration: none;}
</style>
@endpush

@section('content')
    <h1 style="margin: 12px;">Поиск по "{{ $q }}"</h1>
        
    <div style="position: relative" class="items">

        <img src="https://images03.nicepage.io/a1389d7bc73adea1e1c1fb7e/45ff09452d05581491e31e57/pexelsphoto3782766.jpeg" alt="" 
        style="width: 100%; opacity: 0.5; position: absolute;">

        <div style="width: 100%; display: flex; flex-diraction: row; flex-wrap: wrap; position: absolute;">
            @foreach ($items as $item)
            <a href="{{ route('items.show', ['slug' => $item->slug ]) }}" style="width: 25%;">
                <div style="display: flex; justify-content: center; padding: 8px; flex-direction: column; aligh-items: center; 
                background-color: #bda0a079; border: 1px solid rgb(235, 223, 223)">
                    @if (is_null($item->main_image))
                        <img src="https://cdn-icons-png.flaticon.com/512/739/739249.png" style="border-radius: 15px;" alt="">
                    @else
                        <img src="{{ $item->main_image }}" style="border-radius: 15px;" alt="">
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
@endsection

