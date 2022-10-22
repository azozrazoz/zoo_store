@extends('app')

@section('page_title', 'Регистрация')

@push('local_styles')
    <style>
        .login_form {
            background-color: white;
            border-radius: 15px;
            margin: 20px;
            padding: 15px;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .login_input {
            width: 350px;
        }
    </style>
@endpush

@section('content')
    <form class="login_form" action="" method="POST">
        @csrf
        <div>
            <input class="login_input" type="email" name="email" placeholder="Email">
        </div>
        <div>
            <input class="login_input" type="password" name="password" placeholder="password">
        </div>
        <div>
            <input class="login_input" type="password" name="password_2" placeholder="password">
        </div>
        <div>
            <input class="login_input" type="submit" value="Регистрация">
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