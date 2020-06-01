<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artista;
use App\Http\Requests\ArtistaSalvarRequest;
use App\Services\RemovedorArtista;

class ArtistasController extends Controller
{
    public function index(Request $request) {
        $artistas = Artista::query()->orderBy('nome')->get();

        $mensagem = $request->session()->get('mensagem');

        return view('artistas.index', compact('artistas', 'mensagem'));
    }

    public function cadastrar() {
        return view('artistas.cadastrar');
    }

    public function salvar(ArtistaSalvarRequest $request) {
        $dados = $request->all();

        $artista = Artista::create($dados);
        
        $request->session()->flash('mensagem', "$artista->nome cadastrado com sucesso!");

        return redirect()->route('artistas.index');
    }

    public function excluir(Request $request, $artistaId, RemovedorArtista $removedorArtista){
        
        $artistaNome = $removedorArtista->removerArtista($artistaId);
    
        $request->session()->flash('mensagem', "$artistaNome excluído com sucesso!");

        return redirect()->route('artistas.index');
    }

    public function atualizar(Request $request, $artistaId) {
        $dados = $request->all();

        $artista = Artista::find($artistaId);

        $artista->update($dados);
    }
}
