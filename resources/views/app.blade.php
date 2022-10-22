<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('page_title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">  

    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/1970/1970499.png" type="image/png">

    <style>
        input {
            font-size: 18px;
            padding: 10px;
            margin: 10px;
        }
        select {
            font-size: 18px;
            padding: 10px;
            margin: 10px;
        }
        .input_text input {
            width: 100%;
        }
        *{margin: 0; padding: 0; font-family: 'Montserrat', sans-serif;}
        header {background:rgb(255, 153, 153); display: flex; flex-direction: row; justify-content: center; }
        .header_content {display: flex; flex-direction: row; justify-content: space-between; width: 100%; max-width: 1024px; min-width: 380px;}
            nav.main__nav {}
            nav.main__nav ol {display: flex; flex-direction: row; list-style-type: none; justify-content: center;}
            nav.main__nav li {margin: 16px;}
            nav.main__nav li a {color: inherit; text-decoration: none;}
            nav.main__nav li a:hover {color: #ffffff; text-decoration: underline;}
            .block_search {display: flex; align-items: center;} 
            .block_search a {color: inherit; text-decoration: none;}    
            .block_search a:hover {color: #ffffff; text-decoration: underline;}
            .search_input {padding: 6px 12px; font-size: 12px; width: 140px;}

        main {display: flex; justify-content: center; min-height: 1000px; background-color: #ffe4e4}
            section {width: 100%; max-width: 1024px; min-width: 380px;}

        footer {background: rgb(255, 153, 153); padding: 60px; text-align: center;}
            p {}


    </style>

    @stack('local_styles')
    @stack('local_scripts')
</head>
<body>
    <header>
        <div class="header_content">
            <nav class="main__nav">
                <ol>
                    <li><a href="{{ route('home') }}">Главная</a></li>
                    <li><a href="{{ route("info.about") }}">О нас</a></li>  
                    <li><a href="{{ route("info.contacts") }}">Контакты</a></li>
                </ol>
            </nav>
            <div class="block_search" style="display: flex; flex-direction: row; align-items: center;">
                <div style="display: flex; flex-direction: row; align-items: center; margin: 0px 20px;">
                    @auth
                        Welcome, {{ auth()->user()->email }}
                        <a style="margin: 0px 10px;" href="{{ route('user.logout') }}">Logout</a>
                    @endauth
                    @guest
                        <a href="{{ route('login') }}">Login</a>
                        ||
                        <a href="{{ route('user.register') }}">Register</a>
                    @endguest
                </div>

                <form action="/search" method="post">
                    @csrf
                    <input class="search_input" type="text" name="q" id="" placeholder="Поиск">
                </form>
            </div>
        </div>
        
    </header>
        
    <main>    
        <section>
            @yield('content')
        </section>
    </main>

    <footer>
        <p>copyright zoostore.com 2022</p>
    </footer>
</body>
</html>