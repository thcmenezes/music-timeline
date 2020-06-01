@extends('layout')

@section('titulo')
Cadastrar Artista
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

<form method="post">
    @csrf
    <div class="form-group">
        <label for="nome">Nome</label>
         <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome do artista/banda">
    </div>

    <div class="form-group">
        <label for="bio">Bio</label>
        <textarea name="bio" class="form-control" id="bio" rows="3"></textarea>
        <small id="bioHelp" class="form-text text-muted">Adicione uma breve biografia do artista.</small>
    </div>

    <button type="submit" class="btn btn-primary">Cadastrar</button>

</form>

@endsection