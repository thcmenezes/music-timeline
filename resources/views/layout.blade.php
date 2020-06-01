<!DOCTYPE html>
<html lang="pt-BR">
<head>
        
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>Music Timeline</title>

    <link href="/css/app.css" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
            Music Timeline
        </a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Linha do tempo</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Artistas
                </a>
                <div class="dropdown-menu navbar-dark bg-dark" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('artistas.cadastrar') }}" style="color: white;">Cadastrar Artista</a>
                    <a class="dropdown-item" href="{{ route('albuns.importar') }}">Importar albuns</a>
                </div>
            </li>
            </ul>
        </div>
    </nav>

    <div class="container">

        <div class="py-5 text-center">
            <h2>@yield('titulo')</h2>
                <p class="lead">
                    Cadastro manual de cantores ou bandas.
                </p>
        </div>

        @yield('conteudo')

    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>