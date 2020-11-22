<?php 

require dirname(__FILE__) . '/vendor/autoload.php';
require './config.php';
use App\services\PokemonService;
use App\repositories\PokemonRepository;

header('Content-Type: application/json');

$pokeService = new PokemonService(new PokemonRepository);
$fullUrl = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$method  = $_SERVER['REQUEST_METHOD'];

$parameters = explode('/', $fullUrl);
$host = $parameters[0];
$url  = isset($parameters[1]) ? $parameters[1] : null;
$id   = isset($parameters[2]) ? $parameters[2] : null;
$route  = strtolower($url) . '_' . strtolower($method);

$routes = [
    'not_found' => function () {
        $response['message'] = 'Route not Found';
        echo json_encode($response);
    },
    'pokemon_get' => function ($request) use ($pokeService) {
        $pokeService->get($request); 
    },
    'pokemon_post' => function ($request) use ($pokeService) {
        $pokeService->create($request); 
    }, 
    'pokemon_put' => function ($request) use ($pokeService) {
        $pokeService->update($request); 
    },
    'pokemon_delete' => function ($request) use ($pokeService) {
        $pokeService->delete($request); 
    }

];
$_POST = json_decode(file_get_contents('php://input'), true);

$request['global'] = in_array($method, ['POST', 'PUT']) ? $_POST : $_GET;
$request['id']     = empty($id) ? null : $id;
$request['method'] = $method;


if(isset($routes[$route])) {
    $routes[$route]( (object) $request);
} else {
    $routes['not_found']();
}
