<?php

namespace App\Services;

class TratamentoAlbumSpotify {

public function filtrarAlbum($album){

    $albumDados = [];

    $albumDados['nome'] = $album->name;
    $albumDados['identificador_externo'] = $album->id;
    $albumDados['data_lancamento'] = $album->release_date;
    $albumDados['capa'] = $album->images[0]->url;

    return $albumDados;
}

}