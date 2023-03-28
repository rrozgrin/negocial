<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Negocial</title>
    <link rel="stylesheet" href="{{ URL::asset('/css/styles.css') }}">

    {{-- chart --}}
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="{{ URL::asset('/js/grafics.js') }}"></script>

</head>
<header>
    <div>
        @include('admin.nav')
    </div>
</header>

<body style="margin-top: 70px">
    <main role="main">
        <div class="container">
            @hasSection('content')
                @yield('content')
            @else
                <p>Não tem conteúdo</p>
            @endif
        </div>
    </main>
</body>

</html>
