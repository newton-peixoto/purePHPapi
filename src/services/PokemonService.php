<?php

namespace App\services;

use App\repositories\PokemonRepository;

class PokemonService {

    private $pokemonRepository;

    function __construct(PokemonRepository $pokemonRepository) {
        $this->pokemonRepository = $pokemonRepository;
    }

    function create(object $request ) {
        $this->pokemonRepository->create( $request );
    }

    function get( object $request) {
        if(isset($request->id)) {
           $this->pokemonRepository->getById($request->id);
        }else {
            $this->pokemonRepository->getAll();
        }
    }

    function delete( object $request) {
        $this->pokemonRepository->delete( $request->id );
    }

    function update( object $request) {
        $this->pokemonRepository->update( $request );
    }

}