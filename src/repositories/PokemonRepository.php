<?php

namespace App\repositories;

use App\services\DataBase;

class PokemonRepository
{

    function __construct(DataBase $db)
    {
        $this->dataBase = $db;
    }


    public function create(object $request)
    {
        $this->validateRequest($request->global, $request->method);
        $newPokemon = ['type' => $request->global['type'], 'name' => $request->global['name']];
        $this->dataBase->add($newPokemon);
        $this->printJson(true, $this->dataBase->getData());
    }

    public function delete($id)
    {
        $pokeArray = $this->dataBase->getData();
        $key = $this->dataBase->getJsonId($id);

        if ($key !== null) {
            unset($pokeArray[$key]);
        } else {
            $this->printJson(false, 'Id Not Found!');
            return;
        }

        $this->dataBase->setData($pokeArray);
        $this->printJson(true, 'Deleted!');
    }

    public function update(object $request)
    {

        $this->validateRequest($request->global, $request->method);
        $pokeArray = $this->dataBase->getData();
        $key = $this->dataBase->getJsonId($request->id);
       
        if ($key === null) {
            $this->printJson(false, 'Id Not Found!');
            return;
        }

        $pokeArray[$key]['name'] = $request->global['name'];
        $pokeArray[$key]['type'] = $request->global['type'];
        $this->dataBase->setData($pokeArray);
        $this->printJson(true, $pokeArray[$key]);   
    }


    private function validateRequest($request, $method)
    {
        $valid = ['type', 'name'];

        foreach ($valid as $required) {
            if (!in_array($required, array_keys($request))) {
                $this->printJson(false, 'Field ' . $required . ' is missing!');
                return false;
            }
        }

        return true;
    }

    public function getAll()
    {
        $this->printJson(true, $this->dataBase->getData());
    }

    public function getById($id)
    {
        $pokemon = $this->dataBase->getById($id);
        $this->printJson($pokemon == null ? false : true, $pokemon);
    }

    public function printJson($success, $data)
    {
        echo json_encode(
            [
                'success' => $success,
                'data' => $data
            ]
        );
    }
}
