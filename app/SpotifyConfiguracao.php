<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpotifyConfiguracao extends Model
{
    public $table = 'spotify_configuracoes';

    protected $fillable = [
        'token'
    ];

    protected $searchable = [
        'token'
    ];
}
