<?php

namespace App\Services;

use SpotifyWebAPI;
use App\SpotifyConfiguracao;

class AuthSpotify {

    public static function iniciarSessao() {
        $session = new SpotifyWebAPI\Session(
            'd81d66b79fc145dc89ef04b4a8388b27',
            'abde71c071c84df0b42d69b81bf69c8f'
        );
        
        $session->requestCredentialsToken();
        $accessToken = $session->getAccessToken();
        
        $spotifyConfiguracao = SpotifyConfiguracao::first();

        if($spotifyConfiguracao) {
            $spotifyConfiguracao->update(['token' => $accessToken]);
        } else {
            $spotifyConfiguracao = new SpotifyConfiguracao;
            $spotifyConfiguracao->create(['token' => $accessToken]);
        }

        //dd($spotifyConfiguracao);
        // Store the access token somewhere. In a database for example.
        
        //header('Location: some-other-file.php');
        //die();
    }
}

