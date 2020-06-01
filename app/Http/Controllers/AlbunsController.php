<?php

namespace App\Http\Controllers;

use SpotifyWebAPI\SpotifyWebAPI;
use App\Album;
use App\Artista;
use App\SpotifyConfiguracao;
use Illuminate\Http\Request;
use App\Services\AuthSpotify;
use App\Services\TratamentoBuscaSpotify;
use App\Services\TratamentoAlbumSpotify;
use Illuminate\Support\Facades\DB;

class AlbunsController extends Controller
{
    public function index(Request $request, $artistaId){
        $artista = Artista::find($artistaId);
        $albuns = Artista::find($artistaId)->albuns;

        $mensagem = $request->session()->get('mensagem');
        
        return view('albuns.index', compact('albuns', 'artista', 'mensagem'));
    }

    public function importar(Request $request) {
        
        $mensagem = $request->session()->get('mensagem');

        return view('albuns.importar', compact('mensagem'));
    }

    public function buscarArtista(Request $request) {
        $dados = $request->all();
        
        // Inicia a sessão com o Spotify
        $sessaoSpotify = AuthSpotify::iniciarSessao();

        // Recupera as informações necessarias para realizar acesso à API
        $configuracaoSpotify = SpotifyConfiguracao::first();

        // Instancia objeto de acesso à API
        $api = new SpotifyWebAPI();

        // Setar o token para permitir consultas à API
        $api->setAccessToken($configuracaoSpotify->token);

        // Realizar busca de artista pelo termo passado na requisição   
        $results = $api->search($dados['artista_nome'], 'artist');
      
        // Tratar e retornar apenas o artista procurado (termo exato)
        $tratamento = new TratamentoBuscaSpotify;
        $artista = $tratamento->filtrarBusca($results, $dados['artista_nome']);

        // Monta resposta que será repassada via AJAX (JSON)
        $resposta[] = [
            'nome' => $artista->name,
            'identificador_externo' => $artista->id,
            'url_imagem' => $artista->images[2]->url,
        ];

        //dd($artista);
        //$mensagem = $request->session()->get('mensagem');

        return response()->json(compact('success', 'resposta'), 200);
    }

    public function importarSpotify(Request $request) {
        $dados = $request->all();

        // Cadastrar Artista
        $artista = Artista::create($dados);

        // Inicia a sessão com o Spotify
        $sessaoSpotify = AuthSpotify::iniciarSessao();

        // Recupera as informações necessarias para realizar acesso à API
        $configuracaoSpotify = SpotifyConfiguracao::first();

        // Instancia objeto de acesso à API
        $api = new SpotifyWebAPI();

        // Setar o token para permitir consultas à API
        $api->setAccessToken($configuracaoSpotify->token);

        $albums = $api->getArtistAlbums($artista->identificador_externo, ['limit' => 50]);

        $tratador = new TratamentoAlbumSpotify;

        DB::beginTransaction();

        foreach($albums->items as $album) {
            $dadosFiltrados = $tratador->filtrarAlbum($album);

            $dadosFiltrados['artista_id'] = $artista->id;
            
            $album = Album::create($dadosFiltrados);
        }

        DB::commit();

        //dd("redirecionar para discografia do artista");

        return redirect()->route('albuns.index', ['artistaId' => $artista->id ]);
    }

    public function excluir(Request $request, $albumId){
        
        $album = Album::find($albumId);
        $albumNome = $album->nome;

        $album->delete();
    
        $request->session()->flash('mensagem', "$albumNome excluído com sucesso!");

        return redirect()->route('albuns.index', ['artistaId' => $album->artista_id ]);
    }
}
