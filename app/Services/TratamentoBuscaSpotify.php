<?php

namespace App\Services;

class TratamentoBuscaSpotify {

public function filtrarBusca($resultado, $termo){

    $artistaFiltrado = null;

    $artistas = $this->getArtistas($resultado);

    foreach($artistas as $artista){
        if(strcasecmp($artista->name, $termo) == 0) {
            $artistaFiltrado = $artista;
        }
    }

    return $artistaFiltrado;
}

private function getArtistas($resultado) {
    
    $artista = null;

    if($resultado->artists->items){
        $artista = $resultado->artists->items;
    }
    
    return $artista;
}

}