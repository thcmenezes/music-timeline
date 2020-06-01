<?php
namespace App\Services;

use App\Artista;
use App\Album;
use Illuminate\Support\Facades\DB;

class RemovedorArtista {

    public function removerArtista(int $artistaId) {

        $artista = Artista::find($artistaId);
        $nomeArtista = $artista->nome;

        DB::beginTransaction();
       
        // Excluíndo todos os albuns do artista
        $this->removerAlbuns($artista);

        // Excluíndo o artista
        $artista->delete();

        DB::commit();

        return $nomeArtista;
    }

    private function removerAlbuns(Artista $artista){
          // Excluíndo todos os albuns do artista
          $artista->albuns->each(function (Album $album){
            $album->delete();
        });
    }

}
