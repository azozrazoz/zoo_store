@extends('app')

@section('page_title', 'Редактирование товара')

@push('local_styles')
    <style>
        h1 {padding: 12px;}

        form {}
        form div {padding: 12px;}
        input[type=text] {padding: 6px 12px; width: 350px;}
        input[type=number] {padding: 6px 12px; width: 240px;}
        input[type=submit] {padding: 6px 12px; width: 240px;}
        textarea {padding: 6px 12px; width: 240px; height: 250px;}

        .hidden {
            display: none;
        }
    </style>
@endpush

@push('local_scripts')
    <script src='https://code.jquery.com/jquery-3.6.1.min.js'></script>
    <script>
        $(function(){
            $('#tag_attach__select').change(function(){
                var thisVal = $(this).val()
                
                $('#new_tag__input').addClass('hidden')

                if (thisVal == 'new') {
                    $('#new_tag__input').removeClass('hidden')
                }
            })
        })
    </script>
@endpush


@section('content')
    <h1>Редактирование товара</h1>

    <div style="display: flex; flex-direction: row;">
        <form action="{{ route('items.update', ['slug' => $item->slug]) }}" method="POST">
            @csrf
            <div>
                <select name="animal_id">
                    <option value="">Без категории</option>
                    @foreach($animals as $category)
                        <option value="{{ $category->id }}" @if($item->animal_id == $category->id) selected @endif>{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>
    
            <div class="input_text">
                <input type="text" name="title" value="{{ $item->title }}"/>
            </div>
            <div class="input_text">
                <textarea name="description">{{ $item->description }}</textarea>
            </div>
            <div>
                <input type="number" name="price" value="{{ $item->price }}"/>
            </div>
            <div>
                <input type="text" name="main_image" value="{{ $item->main_image }}" style="width: 500px;"/>
            </div>
            
            <div>
                <img src="{{ $item->main_image }}" style="height: 250px;" alt="">
            </div>

            <div>
                <input type="submit" value="Сохранить">
            </div>
        </form>
        
        <div>
            <h3>Привязанные тэги</h3>
            
            @foreach ($item->tags as $tag)
                <div>
                    <h1>{{ $tag->title }}</h1>
                    <form action="{{ route('items.detach_tag', [ 'slug'=> $item->slug ]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="tag_id" value="{{ $tag->id }}"/>
                        <input type="submit" value="Удалить"/>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
        

    <div>
        <h3>Добавить к товару тэг</h3>
        <form method="post" action="{{ route('items.attach_tag', ['slug' => $item->slug ]) }}">
            @csrf
            <select id="tag_attach__select" name="tag_id">
                @foreach ($tags as $tag)
                <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                @endforeach  
                <option value="new">Новый тэг</option>
            </select>
            <input type="text" id="new_tag__input" class="hidden" name="new_tag_title" />
            <input type="submit" value="Добавить">
        </form>

        
        <a href="{{ route('items.list') }}" style="text-decoration: none;">
            <div style="background-color: white; padding: 15px; border-radius: 15px; text-align:center;">
                Редактирование категорий
            </div>
        </a>
    </div>

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