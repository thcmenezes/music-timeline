<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/artistas', 'ArtistasController@index')->name('artistas.index');
Route::get('/artistas/cadastrar', 'ArtistasController@cadastrar')->name('artistas.cadastrar');
Route::post('/artistas/cadastrar', 'ArtistasController@salvar')->name('artistas.salvar');
Route::delete('/artistas/excluir/{artistaId}', 'ArtistasController@excluir')->name('artistas.excluir');
Route::post('/artistas/atualizar/{artistaId}', 'ArtistasController@atualizar')->name('artistas.atualizar');

Route::get('/artistas/{artistaId}/albuns', 'AlbunsController@index')->name('albuns.index');

Route::get('/albuns/importar', 'AlbunsController@importar')->name('albuns.importar');
Route::get('/albuns/buscar_artista', 'AlbunsController@buscarArtista')->name('albuns.buscar_artista');
Route::post('/albuns/importar/spotify', 'AlbunsController@importarSpotify')->name('albuns.importar_spotify');
Route::delete('/albuns/excluir/{albumId}', 'AlbunsController@excluir')->name('albuns.excluir');