<?php

namespace App\repositories;

class PokemonRepository {

    public function create(object $request) {

        $this->validateRequest($request->global, $request->method);
        $pokeArray = json_decode(file_get_contents(SITE_ROOT . '/src/databases/database.json') , true);
        $id = strtotime(date('Y-m-d H:i:s'));
        array_push($pokeArray, ['id' => $id, 'type' => $request->global['type'], 'name' => $request->global['name'] ]  );
        file_put_contents(SITE_ROOT . '/src/databases/database.json', json_encode($pokeArray));
        echo json_encode(['success' => true, 'data' => end($pokeArray)]);
    }

    public function delete($id) {
        $pokeArray = json_decode(file_get_contents(SITE_ROOT . '/src/databases/database.json') , true);
        $key = array_search($id, array_column($pokeArray, 'id'));

        if( is_numeric($key) ) {
            unset($pokeArray[$key]);
        }else {
            $response['success'] = false;
            $response['data'] = 'Id Not Found!';
            echo json_encode($response);
            exit();
        }
        file_put_contents(SITE_ROOT . '/src/databases/database.json', json_encode(array_values($pokeArray)));
        echo json_encode(['success' => true, 'data' => 'Deleted!' ]);
    }

    public function update(object $request) {

        $this->validateRequest($request->global, $request->method);
        $pokeArray = json_decode(file_get_contents(SITE_ROOT . '/src/databases/database.json') , true);
        $key = array_search($request->id, array_column($pokeArray, 'id'));

        if( is_numeric($key) ) {

            $pokeArray[$key]['name'] = $request->global['name'];
            $pokeArray[$key]['type'] = $request->global['type'];
        }else {
            $response['success'] = false;
            $response['data'] = 'Id Not Found!';
            echo json_encode($response);
            exit();
        }
        file_put_contents(SITE_ROOT . '/src/databases/database.json', json_encode($pokeArray));
        echo json_encode(['success' => true, 'data' => $pokeArray[$key] ]);
    }


    private function validateRequest($request, $method) {
        $valid = ['type', 'name'];
        
        foreach($valid as $required) {
            if(!in_array($required, array_keys($request))) {
                echo json_encode( ['success' => false, 'data' => 'Field ' . $required .' is missing!'] );
                exit();
            }
        }

       return true;
    }

    public function getAll() {
        $file =  file_get_contents(__DIR__ . '/../databases/database.json');
        $pokeArray = json_decode($file, true);

        $response['success'] = true;
        $response['data'] = $pokeArray;
        echo json_encode($response);
    }

    public function getById($id) {
        $file =  file_get_contents(__DIR__ . '/../databases/database.json');
        $pokeArray = json_decode($file, true);
        $key = array_search($id, array_column($pokeArray, 'id'));
        
        if( is_numeric($key) ) {
            $response['success'] = true;
            $response['data'] = $pokeArray[$key];
            echo json_encode($response);
        }else {
            $response['success'] = false;
            $response['data'] = [];
            echo json_encode($response);
        }
    }



}