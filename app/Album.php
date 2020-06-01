<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    public $table = 'albuns';

    protected $fillable = [
        'nome', 'identificador_externo', 'data_lancamento', 'nota', 
        'capa', 'artista_id'
    ];

    /*
    * Relacionamentos
    */
    public function artista() {
        return $this->belongsTo(Artista::class);
    }
}
