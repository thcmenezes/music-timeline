<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artista extends Model
{
    protected $fillable = [
        'nome', 'identificador_externo', 'bio'
    ];

    /*
    * Relacionamentos
    */
    public function albuns() {
        return $this->hasMany(Album::class);
    }
}
