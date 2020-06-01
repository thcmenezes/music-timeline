@extends('layout')

@section('titulo')
Artistas
@endsection

@section('conteudo')

@if(!empty($mensagem))
    <div class="alert alert-success">{{ $mensagem }}</div>
@endif

<a href="{{ route('artistas.cadastrar') }}" class="btn btn-dark mb-2">Cadastrar</a>

<div class="form-group mt-3">
        <label for="nome">Buscar</label>
        <input type="text" id="filtro-artista" class="form-control" placeholder="Busque pelo nome do artista/banda">
</div>

<ul class="list-group">
    @foreach($artistas as $artista)
        <li class="list-group-item d-flex  justify-content-between align-items-center artista">
            <span id="nome-artista-{{ $artista->id }}" class="artista-titulo"> {{ $artista->nome }} </span>
            
            <div class="input-group w-50" id="inputs-artista-{{ $artista->id }}" hidden>
                <div class="input-group-append">
                    <input name="nome" type="text" class="form-control mr-3 valor-artista" value="{{ $artista->nome }}">

                    <input name="identificador_externo" type="text" class="form-control mr-3 valor-artista" value="{{ $artista->identificador_externo }}" placeholder="ID do artista no Spotify">
                    <button class="btn-primary mr-3 atualiza-artista" data-artista="{{ $artista->id }}">
                        <i class="fas fa-check"></i>
                    </button>
                    @csrf
                </div>
            </div>

            <span class="d-flex">
                <button class="btn btn-info btn-sm mr-1 editar-artista" data-artista="{{ $artista->id }}">
                    <i class="fas fa-edit"></i>
                </button>
                <a href="/artistas/{{ $artista->id }}/albuns" class="btn btn-info btn-sm mr-1">
                    <i class="fas fa-compact-disc"></i>
                </a>

                <form method="post" action="/artistas/excluir/{{ $artista->id }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm excluir-dado">
                    <i class="fas fa-trash"></i>
                    </button>
                </form>
            </span>
        </li>
    @endforeach
</ul>

<script> 
// Busca
const filtroArtista = document.querySelector("#filtro-artista")
filtroArtista.addEventListener('input', function(){

  var artistas = document.querySelectorAll(".artista")

  if(filtroArtista.value.length > 0) {

    artistas.forEach(function(artista) {
      var artistaNome = artista.querySelector(".artista-titulo").textContent
      var expressao = new RegExp(filtroArtista.value, "i")

      if(!expressao.test(artistaNome)) {
        artista.classList.remove("d-flex")
        artista.classList.add("d-none")
      }
      else {
        artista.classList.add("d-flex")
        artista.classList.remove("d-none")
      }
    })
  } else {
    artistas.forEach(function(artista) {
      artista.classList.add("d-flex")
      artista.classList.remove("d-none")
    })
  } 
})  
</script>
@endsection