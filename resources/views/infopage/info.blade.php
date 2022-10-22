<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>info</title>
    <style>
        * {
            font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }
    </style>
</head>
<body>
    <h1>Hello laravel I am info page</h1>
    <h1>id: {{ $id }}</h1>
    {{-- <h2>Animal: {{ $animal }}</h2> --}}
    <h2>Animal name: {{ $animal->title }}</h2>
    <h2>Animal age: {{ $animal->slug }}</h2>
</body>
</html>