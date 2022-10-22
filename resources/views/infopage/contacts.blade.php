@extends('app')

@section('page_title', 'Коты и Хвосты | Контакты')

@push('local_styles')
    <style>
        iframe {
            height: 350px;
            width: 400px;
            box-shadow: 0px 0px 15px black;
        }
        h1 {
            margin: 15px;
        }
    </style>
@endpush

@section('content')
    <div style="justify-content: center; text-align:center;">
        <h1>Наш адрес</h1>

        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2907.434512568627!2d76.88948551523849!3d43.2213487882663!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3883691eec96d82f%3A0x90a6f0a5abddd9f2!2z0JvQsNGA0LjRgdGBINCY0LLQsNC90L3RgyDQpdCw0YfRgw!5e0!3m2!1sru!2skz!4v1666187726910!5m2!1sru!2skz" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

        <h1>Наши контакты</h1>
        <p>
            +8-777-777-77-77
            <br>
            +8-777-777-77-76
        </p>
    </div>
@endsection