@extends('layout')

@section('titulo')
Discografia de {{ $artista->nome }}
@endsection

@section('conteudo')

@if(!empty($mensagem))
    <div class="alert alert-success">{{ $mensagem }}</div>
@endif

<ul class="list-group">
    @forelse($albuns as $album)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ $album->nome }}

            <span class="d-flex">
                <form method="post" action="/albuns/excluir/{{ $album->id }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm excluir-dado">
                    <i class="fas fa-trash"></i>
                    </button>
                </form>
            </span>
        </li>
    @empty
        <li class="list-group-item">
            Nenhum álbum cadastrado
        </li>
    @endforelse
</ul>

@endsection
