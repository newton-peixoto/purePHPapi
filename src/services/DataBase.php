<?php

namespace App\services;

class DataBase
{
    private $data;
    private $dataPath;

    function __construct()
    {
        $this->dataPath = SITE_ROOT . '/src/databases/database.json';
        $this->data = json_decode(file_get_contents($this->dataPath), true);
    }

    public function getData()
    {
        $this->reload();
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
        file_put_contents($this->dataPath, json_encode($this->data));
        $this->reload();
    }

    public function add($newPokemon)
    {
        $newPokemon['id'] = abs(crc32(uniqid()));
        array_push($this->data, $newPokemon);
        file_put_contents($this->dataPath, json_encode($this->data));
        $this->reload();
    }

    public function getById($id)
    {
        $key = $this->getJsonId($id);

        if ($key !== null) {
            return $this->data[$key];
        }

        return null;
    }

    public function getJsonId($id)
    {
        $key = array_search($id, array_column($this->data, 'id'));
        return $key !== false ? $key : null;
    }

    public function commit()
    {
        file_put_contents(SITE_ROOT . '/src/databases/database.json', json_encode($this->data));
    }

    private function reload()
    {
        $this->dataPath = SITE_ROOT . '/src/databases/database.json';
        $this->data = json_decode(file_get_contents($this->dataPath), true);
    }
}
