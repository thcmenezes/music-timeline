@extends('layout')

@section('titulo')
Importar Álbuns
@endsection

@section('conteudo')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div>
    <div class="form-group">
        <label for="nome">Escolha o artista</label>
         <input type="text" name="artista_nome" id="artista_nome" class="form-control" placeholder="Nome do artista/banda">
    </div>

    <button class="btn btn-primary pesquisar-artista">Pesquisar</button>
</div>

<div id="artista-area" class="media mt-5 p-4 border border-secondary rounded bg-light d-none">
  <img id="artista-imagem" class="mr-3" src="" alt="Generic placeholder image">
  <div class="media-body">
    <h4 id="artista_titulo" class="mt-0">U2</h4>
    <form method="post" action="/albuns/importar/spotify">
        <div class="form-group">
            @csrf
            <label id="artista_id" class="font-weight-bold mt-2">ID Spotify</label>
            
            <input name="identificador_externo" type="text" class="form-control-plaintext font-italic" value="oxdm462m333zyy590ppaos">
            <input type="hidden" id="nome" name="nome" value="teste">
        </div> 
        <button type="submit" class="btn btn-success">Importar álbuns (Spotify)</button>
    </form>   
  </div>
</div>

@endsection